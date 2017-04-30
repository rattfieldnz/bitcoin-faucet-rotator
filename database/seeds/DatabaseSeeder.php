<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('ad_block')->truncate();
        DB::table('twitter_config')->truncate();
        DB::table('main_meta')->truncate();
        DB::table('referral_info')->truncate();
        DB::table('users')->truncate();
        DB::table('faucet_payment_processor')->truncate();
        DB::table('payment_processors')->truncate();
        DB::table('keywords')->truncate();
        DB::table('faucets_keywords')->truncate();
        DB::table('keywords_payment_processors')->truncate();
        DB::table('faucets')->truncate();


        $this->call(FaucetsTableSeeder::class);
        $this->call(PaymentProcessorsTableSeeder::class);
        $this->call(FaucetPaymentProcessorsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ReferralInfoTableSeeder::class);
        $this->call(MainMetaTableSeeder::class);
        $this->call(TwitterConfigTableSeeder::class);
        $this->call(AdBlockSeeder::class);
        //$this->call(KeywordTableSeeder::class);


        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        Model::reguard();
    }
}
