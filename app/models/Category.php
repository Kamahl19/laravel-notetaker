<?php

class Category extends Eloquent {

  protected $table = 'categories';

  protected $guarded = array('id');

	protected $fillable = array('name'); 
  
  public function get_categories_menu() {
    return DB::table('categories')       
                  ->leftJoin('notes', 'categories.id', '=', 'notes.category')
                  ->select(DB::raw('categories.id, name, count(notes.id) as notes'))
                  ->orderBy('name', 'ASC')
                  ->groupBy('categories.id')
                  ->get();
  }
  
  public function get_categories_list($pagination) {
    return DB::table('categories')       
                  ->leftJoin('notes', 'categories.id', '=', 'notes.category')
                  ->select(DB::raw('categories.id, name, count(notes.id) as notes'))
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
