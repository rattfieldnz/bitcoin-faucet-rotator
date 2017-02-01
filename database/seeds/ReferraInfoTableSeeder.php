<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 03-Mar-2015
 * Time: 20:46
 */

use App\Faucet;
use App\User;
use Illuminate\Database\Seeder;

class ReferralInfoTableSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('referral_info')->truncate();

        $user_id = User::where('user_name', env('ADMIN_USERNAME'))->first()->id;
        $faucets = Faucet::all();

        foreach ($faucets as $faucet) {
            DB::table('referral_info')->insert([
                [
                    'faucet_id' => $faucet->id,
                    'user_id' => $user_id
                ]
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
