<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTeamRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_team_roles', function(Blueprint $table)
		{
      $table->integer('user_id');
      $table->integer('team_id');
      $table->integer('role');
      
      $table->unique(array('user_id', 'team_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_team_roles');
	}

}
