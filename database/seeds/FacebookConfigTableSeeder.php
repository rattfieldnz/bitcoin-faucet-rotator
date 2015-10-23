<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 23-Oct-2015
 * Time: 23:01
 */


use App\User;
use App\FacebookConfig;
use Illuminate\Database\Seeder;


class FacebookConfigTableSeeder extends Seeder
{
    public function run()
    {
        $keys = [];
        $user = User::find(1);
        $facebookConfig = new FacebookConfig();

        $keys['app_id'] = env('FACEBOOK_APP_ID');
        $keys['app_secret'] = env('FACEBOOK_APP_SECRET');
        $keys['access_token'] = env('FACEBOOK_ACCESS_TOKEN');
        $keys['facebook_id'] = env('FACEBOOK_ID');
        $keys['user_id'] = $user->id;

        $facebookConfig->fill($keys);
        $facebookConfig->save();
    }

}