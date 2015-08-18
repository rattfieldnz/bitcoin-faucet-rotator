<?php namespace App\Console;

use App\Helpers\Functions\Faucets;
use App\Helpers\Social\Twitter;
use App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Auth;

class Kernel extends ConsoleKernel {
    
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{

		$schedule->command('inspire')
				 ->hourly();

        $schedule->call(function () {
            Faucets::checkUpdateStatuses();
        })->hourly()->environments('production');

        $schedule->call(function(){
            $user = User::where('is_admin', '=', true)->firstOrFail();
            $twitter = new Twitter($user);
            $twitter->sendRandomFaucetTweet();
        })->hourly()->environments('production');
		
	}

    /**
     * The bootstrap classes for the application.
     *
     * @return void
     */
    protected $bootstrappers = [
        'Illuminate\Foundation\Bootstrap\DetectEnvironment',
        'Illuminate\Foundation\Bootstrap\LoadConfiguration',
        'App\Bootstrap\ConfigureLogging',
        'Illuminate\Foundation\Bootstrap\RegisterFacades',
        'Illuminate\Foundation\Bootstrap\SetRequestForConsole',
        'Illuminate\Foundation\Bootstrap\RegisterProviders',
        'Illuminate\Foundation\Bootstrap\BootProviders',
    ];

}
