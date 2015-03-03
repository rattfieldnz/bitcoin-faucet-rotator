<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Illuminate\Support\Facades\Hash;
//use Laracasts\TestDummy\Factory as TestDummy;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('users')->truncate();

        DB::table('users')->insert(array(
            [
                'user_name'=>'admin',
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email'=>'admin@example.com',
                'password'=>Hash::make('password'),
                'bitcoin_address' => '13vYNWKj3npQTYr7EJVBhcoVkwncEbDUvJ',
                'is_admin' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ));

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}