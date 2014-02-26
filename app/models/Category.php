<?php

class Category extends Eloquent {

  protected $table = 'categories';
  protected $guarded = array('id');
	protected $fillable = array('name'); 
  
  public function get_categories($pagination = 999) {
    return DB::table('categories')       
                  ->leftJoin('notes', 'categories.id', '=', 'notes.category')
                  ->select(DB::raw('categories.id, categories.name, COUNT(notes.id) AS notes'))
                  ->orderBy('name', 'ASC')
                  ->groupBy('categories.id')
                  ->paginate($pagination);
  }
  
  public function get_categories_select() {
    return array('' => '') + Category::orderBy('name', 'ASC')
                                      ->get()
                                      ->lists('name', 'id');
  }

}
