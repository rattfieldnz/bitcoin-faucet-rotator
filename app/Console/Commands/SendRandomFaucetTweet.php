<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 25/09/2016
 * Time: 8:13 PM
 */

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Helpers\Social\Twitter;
use App\User;

class SendRandomFaucetTweet extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'send-random-tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command to send a random faucet tweet to a designated Twitter account.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $user = User::where('is_admin', '=', true)->firstOrFail();
        $twitter = new Twitter($user);

        if($twitter != null){
            $twitter->sendRandomFaucetTweet();
        }
    }
}