<?php

class Team extends Eloquent {

  protected $guarded = array('id');
	protected $fillable = array('name', 'email'); 
  
  

}
