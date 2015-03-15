<?php
namespace App\Bootstrap;

use Illuminate\Log\Writer;
use Monolog\Logger as Monolog;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class ConfigureLogging
 *
 * Setup Custom Logging
 *
 * @package App\Bootstrap
 */
class ConfigureLogging
{
    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $logger = new Writer(new Monolog($app->environment()), $app['events']);

        // Daily files are better for production stuff
        $logger->useDailyFiles(storage_path('/logs/laravel.log'));

        $app->instance('log', $logger);

        // Next we will bind the a Closure to resolve the PSR logger implementation
        // as this will grant us the ability to be interoperable with many other
        // libraries which are able to utilize the PSR standardized interface.
        $app->bind('Psr\Log\LoggerInterface', function ($app) {
            return $app['log']->getMonolog();
        });

        $app->bind('Illuminate\Contracts\Logging\Log', function ($app) {
            return $app['log'];
        });
    }
}