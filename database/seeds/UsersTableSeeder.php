<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//use Laracasts\TestDummy\Factory as TestDummy;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{

    public function run()
    {

        try {
            $user = new User(
                [
                    'user_name' => env('ADMIN_USERNAME'),
                    'first_name' => env('ADMIN_FIRSTNAME'),
                    'last_name' => env('ADMIN_LASTNAME'),
                    'email' => env('ADMIN_EMAIL'),
                    'password' => bcrypt(env('ADMIN_PASSWORD')),
                    'bitcoin_address' => env('ADMIN_BITCOINADDRESS'),
                    'is_admin' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
            $user->save();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}
