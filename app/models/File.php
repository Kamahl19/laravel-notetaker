<?php

class File extends Eloquent {

	protected $guarded = array('id');

	protected $fillable = array('note_id', 'folder', 'filename', 'filesize');
  
}
