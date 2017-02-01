<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//use Laracasts\TestDummy\Factory as TestDummy;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('users')->truncate();

        DB::table('users')->insert(array(
            [
                'user_name'=>env('ADMIN_USERNAME'),
                'first_name' =>env('ADMIN_FIRSTNAME'),
                'last_name' =>env('ADMIN_LASTNAME'),
                'email'=>env('ADMIN_EMAIL'),
                'password'=>Hash::make(env('ADMIN_PASSWORD')),
                'bitcoin_address' => env('ADMIN_BITCOINADDRESS'),
                'is_admin' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ));

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
