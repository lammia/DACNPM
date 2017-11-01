<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Group')->insert([
        'idGroup'=>'1',
        'nameGroup'=>'admin',
        'note'=>'',
        ]);
    }
}
