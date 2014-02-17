<?php

class Note extends Eloquent {

	protected $guarded = array('id');

	protected $fillable = array('title', 'text', 'priority', 'category', 'deadline', 'finished');
  
}
