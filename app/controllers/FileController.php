<?php

class FileController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    $file = Input::file('file');

    $destinationPath = 'uploads/'.str_random(8);
    $filename = $file->getClientOriginalName();

    $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
     
    if ($uploadSuccess)
    {
       return Response::json('success', 200);
    }
    else
    {
       return Response::json('error', 400);
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

	}

}