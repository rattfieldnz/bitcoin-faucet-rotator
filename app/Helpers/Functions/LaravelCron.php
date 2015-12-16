<?php namespace App\Helpers\Functions;

/**
 * Class LaravelCron
 *
 * A class to handle Laravel-specific cron jobs.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Helpers\Functions
 */
class LaravelCron
{

    /**
     * A function to check whether a cron job for the
     * specific command exists.
     *
     * @param $command
     * @return bool
     */
    public static function cronExists($command)
    {

        $cronjobExists = false;
        exec('crontab -l', $crontab);
        if (isset($crontab) && is_array($crontab)) {
            $crontab = array_flip($crontab);
            if (isset($crontab[$command])) {
                $cronjobExists = true;
            }
        }
        return $cronjobExists;
    }

    /**
     * A function to initialise the scheduler cron job.
     */
    public static function initialize()
    {
        $command = '* * * * * php ' . base_path() . '/artisan schedule:run 1>> /dev/null 2>&1';

        if (self::cronExists($command) == false) {
            //add job to crontab
            exec('echo -e "`crontab -l`\n'.$command.'" | crontab -');
        }
    }
}
