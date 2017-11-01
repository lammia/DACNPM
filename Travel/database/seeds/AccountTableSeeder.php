<?php

use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Account')->insert([
        'idAccount'=>'1',
        'nameAccount'=>'Lam',
        'email'=>'lam@gmail.com',
        'password'=>'12345678',
        'address'=>'Nghe An',
        'phone'=>'0123456789',
        'img'=>'',
        'description'=>'b',
        ]);
    }
}
