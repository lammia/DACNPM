<?php

use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Province')->insert([
        'idProvince'=>'1',
        'name'=>'An Giang',
        ]);
    }
}
