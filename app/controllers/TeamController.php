<?php

class TeamController extends \BaseController {

  protected $team;
  protected $user_team_role;
  
  /**
  * Inject the models.
  * @param Team $team  
  */
  public function __construct(Team $team, UserTeamRole $user_team_role)
  {
    parent::__construct();
    
    $this->team = $team;
    $this->user_team_role = $user_team_role;
  }

  /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    return View::make('team.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    $rules = array(
      'name'  => 'required',
      'email' => 'required|email',
		);
		$validator = Validator::make(Input::all(), $rules);
    
    if ($validator->fails())
    {                   
			return Redirect::to('team/create')
                      ->withErrors($validator)
                      ->withInput();
		}
    else
    {
			$last_id = Team::create(array(
				'name'  => Input::get('name'),
				'email' => Input::get('email'),
			))->id;
      
      $this->user_team_role->add_member(Confide::User()->id, $last_id, TEAM_OWNER);

			return Redirect::to('team/'.$last_id);
		}
	}      
  
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$team = Team::find($id); 
    
    $user_team_role = $this->user_team_role->get_user_role(Confide::user()->id); 
    
    if ($user_team_role == TEAM_OWNER)
    { 
      $members = $this->user_team_role->get_team_members($team->id); 
      
  		return View::make('team.edit')
                  ->with('members', $members)
                  ->with('team', $team);
    }
    else
    {
      return Redirect::to('/');
    }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
    $team = Team::find($id); 
    
    $user_team_role = $this->user_team_role->get_user_role(Confide::user()->id); 
    
    if ($user_team_role == TEAM_OWNER)
    {
  		$rules = array(
        'name'  => 'required',
        'email' => 'required|email',
  		);
  		$validator = Validator::make(Input::all(), $rules);
  
      if ($validator->fails())
      {
  			return Redirect::to('team/' . $id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
  		}
      else
      {
  			$team->name  = Input::get('name');
  			$team->email = Input::get('email');
  
  			$team->save();
  		}
    }
    
    return Redirect::to('team' . $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
    $team = Team::find($id);
    
    $user_team_role = $this->user_team_role->get_user_role(Confide::user()->id);
    
    if ($user_team_role == TEAM_OWNER)
    {
      Team::destroy($id);
      $this->user_team_role->remove_team_members($id);
    }

		return Redirect::to('/');
	}

}