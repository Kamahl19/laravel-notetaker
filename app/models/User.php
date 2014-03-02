<?php

use Zizaco\Confide\ConfideUser;

class User extends ConfideUser {

  protected $table = 'users';
	protected $guarded = array('id');
	protected $fillable = array('username', 'email', 'password', 'confirmation_code', 'confirmed', 'created_at', 'updated_at', 'timezone', 'language');
                
  public function change_password($id, $hashed_password) {
    DB::table('users')
            ->where('id', $id)
            ->update(array('password' => $hashed_password));
  }
}