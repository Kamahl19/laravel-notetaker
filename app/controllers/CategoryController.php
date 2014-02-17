<?php

class CategoryController extends \BaseController {

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
    
		return View::make('categories.index')->with('categories', $categories);
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
      return Response::json(array('status' => '0', 'msg' => $validator->messages()->toJson()));
		}
    else
    {
			$last_id = Category::create(array(
				'name' => Input::get('name'),
			))->id;

      return Response::json(array('status' => '1', 'msg' => $last_id));
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

		$categories = Category::orderBy('name', 'ASC')->get()->lists('name', 'id');

		return View::make('categories.edit')->with('category', $category)->with('categories', $categories);
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

			$category->name		= Input::get('name');

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
    
    DB::table('notes')
            ->where('category', $id)
            ->update(array('category' => 0));

		Session::flash('message', 'Kategória bola zmazaná');
		return Redirect::to('categories');
	}

}