<?php

class UserTeamRole extends Eloquent {

	protected $fillable = array('user_id', 'team_id', 'role'); 
  
  public function add_member($user_id, $team_id, $role)
  {
    $user_team_role = UserTeamRole::firstOrNew(array(
      'user_id' => $user_id,
      'team_id' => $team_id,
      'role' => $role
    ));
    
    $user_team_role->save();
  }
  
  public function get_user_role($user_id)
  {
    return DB::select('SELECT role FROM user_team_roles WHERE user_id = ?', array($user_id));
  }
  
  public function get_team_members($team_id)
  {
    return UserTeamRole::orderBy('role', 'ASC')
                        ->where('team_id', $team_id)
                        ->get()
                        ->lists('user_id', 'role');
  }
  
  public function remove_team_members($team_id)
  {
    UserTeamRole::where('team_id', '=', $team_id)->delete();
  }

}
