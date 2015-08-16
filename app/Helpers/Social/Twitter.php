<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 17-Aug-2015
 * Time: 12:26
 */

namespace Helpers\Social;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\User;

class Twitter
{

    private $keys;
    private $connection;

    public function __construct(User $user){
        $this->setKeys($user);
        $this->setConnection($this->keys);
    }

    private function setKeys(User $user){
        $user_keys = $user->twitterConfig;
        $this->keys = [];
        if($user_keys != null) {
            $this->keys['consumer_key'] = $user_keys->consumer_key;
            $this->keys['consumer_key_secret'] = $user_keys->consumer_key_secret;
            $this->keys['access_token'] = $user_keys->access_token;
            $this->keys['access_token_secret'] = $user_keys->access_token_secret;
        }
    }

    public function sendTweet($message){
        if($this->connectionStatus() == true) {
            $this->connection->post("statuses/update", array("status" => $message));
        }
    }

    public function getKeys(){

        if($this->validateKeys() == true) {
            return $this->keys;
        }else{
            return [];
        }
    }

    private function validateKeys(){
        return $this->connectionStatus();
    }

    private function setConnection($keys){
        $this->connection = new TwitterOAuth(
            $keys['consumer_key'],
            $keys['consumer_key_secret'],
            $keys['access_token'],
            $keys['access_token_secret']
        );
    }

    private function connectionStatus(){
        $content = $this->connection->get("account/verify_credentials");

        return $content->getLastHttpCode() == 200 ? true : false;
    }
}