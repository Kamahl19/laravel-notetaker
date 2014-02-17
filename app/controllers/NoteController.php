<?php

class NoteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    $categories = DB::table('categories')       
                  ->leftJoin('notes', 'categories.id', '=', 'notes.category')
                  ->select(DB::raw('categories.id, name, count(notes.id) as notes'))
                  ->orderBy('name', 'ASC')
                  ->groupBy('categories.id')
                  ->get();
                  
    $notes = DB::table('notes')       
                  ->leftJoin('categories', 'notes.category', '=', 'categories.id')
                  ->select('notes.id', 'title', 'text', 'priority', 'finished', 'notes.created_at', 'deadline', 'name')
                  ->paginate(20);
        
		foreach ($notes as &$note)
		{
			$note->deadline = date("d.m.Y H:i", strtotime($note->deadline));
		}

		return View::make('notes.index')->with('notes', $notes)->with('categories', $categories);
	}
  
  /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    $categories = DB::table('categories')       
                  ->leftJoin('notes', 'categories.id', '=', 'notes.category')
                  ->select(DB::raw('categories.id, name, count(notes.id) as notes'))
                  ->orderBy('name', 'ASC')
                  ->groupBy('categories.id')
                  ->get();
    
		$categories_select = array('' => '') + Category::orderBy('name', 'ASC')->get()->lists('name', 'id');

    return View::make('notes.create')->with('categories', $categories)->with('categories_select', $categories_select);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    $rules = array(
      'title'       => 'required',
      'text'        => 'required',
      'priority'    => 'required|integer',
      'category'    => 'required|integer|exists:categories,id',
      'deadline'    => 'required|date',
		);
		$validator = Validator::make(Input::all(), $rules);
    
    if ($validator->fails())
    {
			return Redirect::to('notes/create')->withErrors($validator)->withInput();
		}
    else
    {
			$deadline_formated = date("Y-m-d H:i:s", strtotime(Input::get('deadline')));
      $finished = ( Input::get('finished') == 'on') ? true : false;
      
			Note::create(array(
				'title'			=> Input::get('title'),
				'text' 			=> Input::get('text'),
	      'priority'	=> Input::get('priority'),
	      'category' 	=> Input::get('category'),
	      'deadline' 	=> $deadline_formated,
	      'finished' 	=> $finished,
			));

			Session::flash('message', 'Poznámka bola vytvorená');
			return Redirect::to('notes');
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
		$note = Note::find($id);     
    
    $categories = DB::table('categories')       
                  ->leftJoin('notes', 'categories.id', '=', 'notes.category')
                  ->select(DB::raw('categories.id, name, count(notes.id) as notes'))
                  ->orderBy('name', 'ASC')
                  ->groupBy('categories.id')
                  ->get();
    
		$categories_select = array('' => '') + Category::orderBy('name', 'ASC')->get()->lists('name', 'id');

		return View::make('notes.edit')->with('note', $note)->with('categories', $categories)->with('categories_select', $categories_select);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
      'title'       => 'required',
      'text'        => 'required',
      'priority'    => 'required|integer',
      'category'    => 'required|integer|exists:categories,id',
      'deadline'    => 'required|date',
		);
		$validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
			return Redirect::to('notes/' . $id . '/edit')->withErrors($validator)->withInput();
		}
    else
    {
			$deadline_formated = date("Y-m-d H:i:s", strtotime(Input::get('deadline')));
      $finished = ( Input::get('finished') == 'on') ? true : false;

			$note = Note::find($id);

			$note->title		= Input::get('title');
			$note->text			= Input::get('text');
			$note->priority	= Input::get('priority');
			$note->category	= Input::get('category');
			$note->deadline	= $deadline_formated;
			$note->finished	= $finished;

			$note->save();

			Session::flash('message', 'Poznámka bola upravená');
			return Redirect::to('notes');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
    Note::destroy($id);

		Session::flash('message', 'Poznámka bola zmazaná');
		return Redirect::to('notes');
	}

}