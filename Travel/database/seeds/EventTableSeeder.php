<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Event')->insert([
        'idEvent'=>'1',
        'nameEvent'=>'a',
        'idPlace'=>'1',
        'timeBeginEvent'=>'2017-10-16 04:14:16',
        'timeEndEvent'=>'2017-10-18 04:14:16',
        'img'=>'a',
        'description'=>'b',
        'idAccount'=>'1',
        ]);
    }
}
