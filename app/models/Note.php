<?php

class Note extends Eloquent {

	protected $guarded = array('id');

	protected $fillable = array('title', 'text', 'priority', 'category', 'deadline', 'finished');
  
  public function get_notes_list($pagination) {
    return DB::table('notes')       
                  ->leftJoin('categories', 'notes.category', '=', 'categories.id')
                  ->select('notes.id', 'title', 'text', 'priority', 'finished', 'notes.created_at', 'deadline', 'name')
                  ->paginate($pagination);
  }
  
  public function reset_category($id) {
    DB::table('notes')
            ->where('category', $id)
            ->update(array('category' => 0));
  }
}
