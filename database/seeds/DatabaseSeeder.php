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

        $this->call(FaucetsTableSeeder::class);
        $this->call(PaymentProcessorsTableSeeder::class);
        $this->call(FaucetPaymentProcessorsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ReferralInfoTableSeeder::class);
        $this->call(MainMetaTableSeeder::class);
        $this->call(TwitterConfigTableSeeder::class);
        $this->call(AdBlockSeeder::class);
        $this->call(KeywordTableSeeder::class);

        Model::reguard();
    }
}
