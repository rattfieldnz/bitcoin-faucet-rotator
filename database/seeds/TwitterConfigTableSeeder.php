<?php

use App\TwitterConfig;
use App\User;
use Illuminate\Database\Seeder;

/**
 * Class TwitterConfigTableSeeder
 */
class TwitterConfigTableSeeder extends Seeder
{
    public function run()
    {
        $keys = [];

        try {
            $user = User::find(1);
            $twitterConfig = new TwitterConfig();

            $keys['consumer_key'] = env('CONSUMER_KEY');
            $keys['consumer_key_secret'] = env('CONSUMER_KEY_SECRET');
            $keys['access_token'] = env('ACCESS_TOKEN');
            $keys['access_token_secret'] = env('ACCESS_TOKEN_SECRET');
            $keys['user_id'] = $user->id;

            $twitterConfig->fill($keys);
            $twitterConfig->save();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}
