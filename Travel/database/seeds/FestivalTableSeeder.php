<?php

use Illuminate\Database\Seeder;

class FestivalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Festival')->insert([
        'idFestival'=>'1',
        'nameFestival'=>'a',
        'idPlace'=>'1',
        'timeBeginFestival'=>'2017-10-16 04:14:16',
        'timeEndFestival'=>'2017-10-18 04:14:16',
        'img'=>'a',
        'description'=>'b',
        'idAccount'=>'1',
        ]);
    }
}
