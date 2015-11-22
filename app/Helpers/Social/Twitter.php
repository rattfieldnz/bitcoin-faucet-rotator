<?php namespace App\Helpers\Social;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Faucet;
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
        $userKeys = $user->twitterConfig;
        if ($userKeys != null) {
            $this->keys['consumer_key'] = $userKeys->consumer_key;
            $this->keys['consumer_key_secret'] = $userKeys->consumer_key_secret;
            $this->keys['access_token'] = $userKeys->access_token;
            $this->keys['access_token_secret'] = $userKeys->access_token_secret;
        }
    }

    public function sendTweet($message)
    {
        $this->connection->post("statuses/update", array("status" => $message));
    }

    public function sendRandomFaucetTweet()
    {
        $faucetCount = count(Faucet::all());
        if ($faucetCount > 0) {
            $numbers = range(0, $faucetCount - 1);
            shuffle($numbers);
            $randomNumber = array_slice($numbers, 0, 1);

            $faucet = Faucet::find($randomNumber[0]);

            $message = "Earn between " . $faucet->min_payout . " and "
                . $faucet->max_payout . " satoshis every " . $faucet->interval_minutes
                . " minute/s from " . url('/faucets/' . $faucet->slug) . " for free :).";

            $this->sendTweet($message);
        }
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
