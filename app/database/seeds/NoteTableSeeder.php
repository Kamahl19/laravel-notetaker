<?php

class NoteTableSeeder extends Seeder 
{

	public function run()
	{
		DB::table('notes')->delete();

		Note::create(array(
			'title' => 'urobit nakup',
			'text' => 'mlieko, rozky, sunku',
      'priority' => 9,
      'category' => 1,
      'deadline' => '2014-02-15 15:00:00',
      'finished' => 0,
		));
    
    Note::create(array(
			'title' => 'opravit auto',
			'text' => 'prave predne dvere sa neotvaraju',
      'priority' => 4,
      'category' => 1,
      'deadline' => '2014-02-20 18:30:00',
      'finished' => 0,
		));
    
    Note::create(array(
			'title' => 'naucit sa na skusku',
			'text' => 'skuska z MSYS po 5. kapitolu',
      'priority' => 6,
      'category' => 2,
      'deadline' => '2014-02-25 07:05:00',
      'finished' => 0,
		));

	}

}