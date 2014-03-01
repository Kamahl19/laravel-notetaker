<?php

class CategoryController extends \BaseController {

  protected $category;
  protected $note;
  
  /**
  * Inject the models.
  * @param Note $note  
  * @param Category $category
  */
  public function __construct(Note $note, Category $category)
  {
    parent::__construct();
    
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
    $categories = $this->category->get_categories();
    
		return View::make('categories.index')
                ->with('categories', $categories);
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
				'name'    => Input::get('name'),
        'user_id' => Confide::user()->id,
			))->id;
      
      if( Request::ajax() )
      {
        return Response::json(array('status' => '1', 'msg' => $last_id));
      } 

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
    
    if ($category->user_id == Confide::user()->id)
    {
		  return View::make('categories.edit')
                  ->with('category', $category);
    }
    else
    {
      return Redirect::to('categories');
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
    $category = Category::find($id);
    
    if ($category->user_id == Confide::user()->id)
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
  			$category->name	= Input::get('name');
  
  			$category->save();
  		}
    }
    
    return Redirect::to('categories');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
    $category = Category::find($id);
    
    if ($category->user_id == Confide::user()->id)
    {
      Category::destroy($id);
      
      $this->note->reset_category($id);
    }

		return Redirect::to('categories');
	}

}