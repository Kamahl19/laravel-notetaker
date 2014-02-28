<?php

class Attachment extends Eloquent {
  
  protected $table = 'attachments';
	protected $guarded = array('id');
	protected $fillable = array('note_id', 'folder', 'filename', 'filesize', 'user_id');
  
  public function update_ids($ids, $note_id) {
    DB::table('attachments')
            ->whereIn('id', $ids)            
            ->update(array('note_id' => $note_id));
  }
  
  public function get_attachments($note_id) {    
    return DB::table('attachments')        
                  ->where('note_id', '=', $note_id)
                  ->where('user_id', Confide::user()->id)
                  ->orderBy('created_at', 'ASC')
                  ->get();
  }
  
}