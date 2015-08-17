<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 17-Aug-2015
 * Time: 12:26
 */

namespace App\Helpers\Social;

use Abraham\TwitterOAuth\TwitterOAuth;
use \App\User;

class Twitter
{

    private $keys;
    private $connection;

    public function __construct(User $user)
    {
        $this->setKeys($user);
        $this->setConnection($this->getKeys());
    }

    private function setKeys(User $user)
    {
        $user_keys = $user->twitterConfig;
        if ($user_keys != null) {
            $this->keys['consumer_key'] = $user_keys->consumer_key;
            $this->keys['consumer_key_secret'] = $user_keys->consumer_key_secret;
            $this->keys['access_token'] = $user_keys->access_token;
            $this->keys['access_token_secret'] = $user_keys->access_token_secret;
        }
    }

    public function sendTweet($message)
    {
        $this->connection->post("statuses/update", array("status" => $message));
    }

    public function getKeys()
    {
        return $this->keys;
    }

    private function setConnection($keys)
    {
        $this->connection = new TwitterOAuth(
            $keys['consumer_key'],
            $keys['consumer_key_secret'],
            $keys['access_token'],
            $keys['access_token_secret']
        );
    }
}