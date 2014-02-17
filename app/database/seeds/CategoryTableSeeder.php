<?php

class CategoryTableSeeder extends Seeder 
{

	public function run()
	{
		DB::table('categories')->delete();

		Category::create(array(
			'name' => 'Osobne',
		));
    
    Category::create(array(
			'name' => 'Skola',
		));
    
    Category::create(array(
			'name' => 'Robota',
		));
    
	}

}