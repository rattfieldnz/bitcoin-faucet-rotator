<?php

use App\MainMeta;
use Illuminate\Database\Seeder;

class MainMetaTableSeeder extends Seeder
{
    public function run()
    {
        $main_meta = new MainMeta([
            'title' => 'FreeBTC.website - Earn Free Bitcoins from our Bitcoin Faucet Rotator',
            'description' => 'Visit our bitcoin faucet rotator and earn upwards of 100,000 free satoshis per day. Intervals from every minute to every 24 hours. We welcome new faucets.',
            'keywords' => 'Free Bitcoins, Bitcoin Faucet Rotator, Satoshis, Free BTC Website',
            'google_analytics_id' => 'UA-57957173-1'
        ]);

        $main_meta->save();
    }
}
