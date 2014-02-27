<?php

class Category extends Eloquent {

  protected $table = 'categories';
  protected $guarded = array('id');
	protected $fillable = array('name', 'user_id'); 
  
  public function get_categories($pagination = 999) {
    return DB::table('categories')       
                  ->leftJoin('notes', 'categories.id', '=', 'notes.category')
                  ->select(DB::raw('categories.id, categories.name, COUNT(notes.id) AS notes'))
                  ->where('categories.user_id', Auth::user()->id)
                  ->orderBy('name', 'ASC')
                  ->groupBy('categories.id')
                  ->paginate($pagination);
  }
  
  public function get_categories_select() {
    return array('' => '') + Category::orderBy('name', 'ASC')
                                      ->where('user_id', Auth::user()->id)
                                      ->get()
                                      ->lists('name', 'id');
  }

}
