<?php

use Illuminate\Database\Seeder;

class PlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Place')->insert([
        'idPlace'=>'1',
        'namePlace'=>'Ngũ Hành Sơn',
        'MoneyToTravel'=>'500000',
        'address'=>'52 Huyền  Trân Công Chúa, Hòa Hai, Ngũ Hành Sơn, Đà Nẵng',
        'idType'=>'1',
        'img'=>'a',
        'description'=>'b',
        'latlog'=>'c',
        'idAccount'=>'1',
        ]);
    }
}
