<?php

use Illuminate\Database\Seeder;

class typePlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('typePlace')->insert([
        // 'idType'=>'1',
        // 'nameType'=>'Ecotourism Travel',
        // ]);
        DB::table('typePlace')->insert([
        'idType'=>'2',
        'nameType'=>'Leisure Travel',
        ]);
        
        // DB::table('typePlace')->insert([
        // 'idType'=>'3',
        // 'nameType'=>'Adventure Travel',
        // ]);
    }
}
