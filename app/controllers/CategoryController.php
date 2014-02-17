<?php

class CategoryController extends \BaseController {

  protected $category;
  protected $note;
  
  /**
  * Inject the models.
  * * @param Note $note  
  * @param Category $category
  */
  public function __construct(Note $note, Category $category)
  {
    $this->note = $note;
    $this->category = $category;
  }

  /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    $categories = $this->category->get_categories_list(20);
    
		return View::make('categories.index')->with('categories', $categories);
	}
  
  /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{                  
    return View::make('categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    $rules = array(
      'name' => 'required|unique:categories',
		);
		$validator = Validator::make(Input::all(), $rules);
    
    if ($validator->fails())
    {
      if( Request::ajax() )
      {
        return Response::json(array('status' => '0', 'msg' => $validator->messages()->toJson()));
      } 
      return Redirect::to('categories/create')->withErrors($validator)->withInput();
		}
    else
    {
			$last_id = Category::create(array(
				'name' => Input::get('name'),
			))->id;
      
      if( Request::ajax() )
      {
        return Response::json(array('status' => '1', 'msg' => $last_id));
      } 

      Session::flash('message', 'Kategória bola vytvorená');
			return Redirect::to('categories');
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
		$category = Category::find($id);     

		return View::make('categories.edit')->with('category', $category);
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
      'name' => 'required|unique:categories',
		);
		$validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
			return Redirect::to('categories/' . $id . '/edit')->withErrors($validator)->withInput();
		}
    else
    {
			$category = Category::find($id);

			$category->name	= Input::get('name');

			$category->save();

			Session::flash('message', 'Kategória bola upravená');
			return Redirect::to('categories');
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
    Category::destroy($id);
    
    $this->note->reset_category($id);

		Session::flash('message', 'Kategória bola zmazaná');
		return Redirect::to('categories');
	}

}