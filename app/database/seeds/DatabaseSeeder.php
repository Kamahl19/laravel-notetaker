<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

    $this->call('NoteTableSeeder');
		$this->command->info('Notes table seeded.');
    
    $this->call('CategoryTableSeeder');
		$this->command->info('Categories table seeded.');
	}

}