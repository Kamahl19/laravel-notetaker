<?php

class NoteController extends \BaseController {

  protected $category;
  protected $note;
  protected $attachment;

  /**
  * Inject the models.
  * @param Note $note
  * @param Category $category  
  * @param Attachment $attachment  
  */
  public function __construct(Note $note, Category $category, Attachment $attachment)
  {
    $this->note = $note;
    $this->category = $category;
    $this->attachment = $attachment;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    $categories = $this->category->get_categories_menu();
    
    $notes = $this->note->get_notes_list(20);
                                         
		foreach ($notes as &$note)
		{
			$note->deadline = ($note->deadline) ? date("d.m.Y H:i", strtotime($note->deadline)) : '';
		}

		return View::make('notes.index')
                ->with('notes', $notes)
                ->with('categories', $categories);
	}
  
  /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    $categories = $this->category->get_categories_menu();
    
    $categories_select = $this->category->get_categories_select();
    
    return View::make('notes.create')
                ->with('categories', $categories)
                ->with('categories_select', $categories_select);
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
      'priority'    => 'integer',
      'category'    => 'required|integer|exists:categories,id',
      'deadline'    => 'date',
		);
		$validator = Validator::make(Input::all(), $rules);
    
    if ($validator->fails())
    {                   
			return Redirect::to('notes/create')->withErrors($validator)->withInput();
		}
    else
    {
			$deadline_formated = (Input::get('deadline')) ? date("Y-m-d H:i:s", strtotime(Input::get('deadline'))) : '';
      $finished = ( Input::get('finished') == 'on') ? true : false;   
      
			$last_id = Note::create(array(
				'title'			=> Input::get('title'),
				'text' 			=> Input::get('text'),
	      'priority'	=> Input::get('priority'),
	      'category' 	=> Input::get('category'),
	      'deadline' 	=> $deadline_formated,
	      'finished' 	=> $finished,
        'url'       => Input::get('url'),
			))->id;
      
      $ids = Input::get('attachment_ids');
      if ( isset($ids) )
      {
        $this->attachment->update_ids($ids, $last_id);
      }

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
    
    $categories = $this->category->get_categories_menu();    
    
    $categories_select = $this->category->get_categories_select();
    
		return View::make('notes.edit')
                ->with('note', $note)
                ->with('categories', $categories)
                ->with('categories_select', $categories_select);
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
      'priority'    => 'integer',
      'category'    => 'required|integer|exists:categories,id',
      'deadline'    => 'date',
		);
		$validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
			return Redirect::to('notes/' . $id . '/edit')->withErrors($validator)->withInput();
		}
    else
    {
			$deadline_formated = (Input::get('deadline')) ? date("Y-m-d H:i:s", strtotime(Input::get('deadline'))) : '';     
      $finished = ( Input::get('finished') == 'on') ? true : false;

			$note = Note::find($id);

			$note->title		= Input::get('title');
			$note->text			= Input::get('text');
			$note->priority	= Input::get('priority');
			$note->category	= Input::get('category');
			$note->deadline	= $deadline_formated;
			$note->finished	= $finished;
      $note->url      = Input::get('url');

			$note->save();
      
      $ids = Input::get('attachment_ids');
      if ( isset($ids) )
      {
        $this->attachment->update_ids($ids, $id);
      }

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

		return Redirect::to('notes');
	}

}