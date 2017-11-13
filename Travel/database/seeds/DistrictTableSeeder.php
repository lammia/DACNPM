<?php

use Illuminate\Database\Seeder;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('District')->insert([
        'idDistrict'=>'1',
        'idProvince'=>'1',
        'name'=>'Long Xuyên',
        ]);
    }
}
