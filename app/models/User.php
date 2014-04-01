<?php

use Zizaco\Confide\ConfideUser;

class User extends ConfideUser {

	protected $guarded = array('id');
	protected $fillable = array('username', 'email', 'password', 'confirmation_code', 'confirmed', 'created_at', 'updated_at', 'timezone', 'language');
                
  public function change_password($id, $hashed_password) {
    DB::table('users')
            ->where('id', $id)
            ->update(array('password' => $hashed_password));
  }
  
  public function activate_automatically($id) {
    DB::table('users')
            ->where('id', $id)
            ->update(array('confirmed' => '1'));
  }
  
  public function delete_account($id) {
    $attachments = DB::table('attachments')->where('user_id', '=', $id)->get();
    
    $uploads_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
    
    foreach ($attachments as $attachment)
    {
      $path = $uploads_path . $attachment->folder . DIRECTORY_SEPARATOR;
      
      @unlink($path . $attachment->filename);  
      
      if ( Functions::is_dir_empty($path) )
      {
        @rmdir($path);
      } 
    }
    
    DB::table('users')->where('id', '=', $id)->delete();
    DB::table('notes')->where('user_id', '=', $id)->delete();
    DB::table('categories')->where('user_id', '=', $id)->delete();
    DB::table('attachments')->where('user_id', '=', $id)->delete();
  }
}