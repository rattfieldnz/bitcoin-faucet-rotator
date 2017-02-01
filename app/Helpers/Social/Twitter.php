<?php namespace App\Helpers\Social;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Faucet;
use \App\User;

/**
 * Class Twitter
 *
 * A class to handle Twitter-related functionality.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @todo Abstract Twitter tweeting functions into another class.
 * @package App\Helpers\Social
 */
class Twitter
{

    private $keys;
    private $connection;

    /**
     * Twitter constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->setKeys($user);
        $this->setConnection($this->getKeys());
    }

    /**
     * A function to set Twitter OAuth keys, obtained from a given user,
     * so Twitter-related functionality can work.
     *
     * @param User $user
     */
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

    /**
     * A function to send a tweet (note: Twitter only allows 140 characters
     * in a single tweet).
     *
     * @param $message
     */
    public function sendTweet($message)
    {
        $this->connection->post("statuses/update", array("status" => $message));
    }

    /**
     * A function used to tweet the details of a Random faucet.
     */
    public function sendRandomFaucetTweet()
    {

        $faucetIds = Faucet::where('id', '>', 0)->pluck('id')->toArray();
        shuffle($faucetIds);
        $randomNumber = array_slice($faucetIds, 0, 1);

        //Obtain a faucet using the random integer.
        $faucet = Faucet::find($randomNumber[0]);

        if ($faucet != null) {
            //Construct a message template based on the random faucet's details.
            $message = "Earn between " . $faucet->min_payout . " and "
                . $faucet->max_payout . " satoshis every " . $faucet->interval_minutes
                . " minute/s from " . url('/faucets/' . $faucet->slug) . " for free :).";

                // Send the tweet of the random faucet.
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
