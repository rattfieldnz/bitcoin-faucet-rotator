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

/**
 * Class ReferralInfoTableSeeder
 */
class ReferralInfoTableSeeder extends Seeder
{

    public function run()
    {
        try {
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
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}
