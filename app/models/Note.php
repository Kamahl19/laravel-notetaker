<?php

class Note extends Eloquent {

  protected $table = 'notes';

	protected $guarded = array('id');

	protected $fillable = array('title', 'text', 'priority', 'category', 'deadline', 'finished', 'url');
  
  public function get_notes_list($pagination) {
    return DB::table('notes')       
                  ->leftJoin('categories', 'notes.category', '=', 'categories.id')
                  ->leftJoin('attachments', 'notes.id', '=', 'attachments.note_id')
                  ->select(DB::raw('notes.id, title, text, priority, finished, notes.created_at, deadline, name, url, COUNT(attachments.id) as files_count'))
                  ->groupBy('notes.id')
                  ->paginate($pagination);
  }
  
  public function reset_category($id) {
    DB::table('notes')
            ->where('category', $id)
            ->update(array('category' => 0));
  }
}
