<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        //$this->call(AccountTableSeeder::class);
        //$this->call(typePlaceTableSeeder::class);
        //$this->call(PlaceTableSeeder::class);
        //$this->call(EventTableSeeder::class);
        //$this->call(FestivalTableSeeder::class);
        //$this->call(GroupTableSeeder::class);
        //$this->call(MemberGroupTableSeeder::class);
        //$this->call(ProvinceTableSeeder::class);
        $this->call(DistrictTableSeeder::class);

    }
}
