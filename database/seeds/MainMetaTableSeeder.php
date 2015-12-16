<?php

use App\MainMeta;
use Illuminate\Database\Seeder;

class MainMetaTableSeeder extends Seeder
{
    public function run()
    {
        MainMeta::truncate();

        $main_meta = new MainMeta([
            'title' => 'FreeBTC.website - Earn Free Bitcoins from our Bitcoin Faucet Rotator',
            'description' => 'Visit our bitcoin faucet rotator and earn upwards of 100,000 free satoshis per day. Intervals from every minute to every 24 hours. We welcome new faucets.',
            'keywords' => 'Free Bitcoins, Bitcoin Faucet Rotator, Satoshis, Free BTC Website',
            'google_analytics_id' => 'UA-57957173-1',
            'yandex_verification' => '6bd366f4a927b8e4',
            'bing_verification' => '01CE0CA0B4512F8EF0B231C935E124E1'
        ]);

        $main_meta->save();
    }
}
