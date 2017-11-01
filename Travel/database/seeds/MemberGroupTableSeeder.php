<?php

use Illuminate\Database\Seeder;

class MemberGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('MemberGroup')->insert([
        'idMember'=>'1',
        'idGroup'=>'2',
        'idAccount'=>'1',
        ]);
    }
}
