<?php namespace App\Helpers\Functions;

class LaravelCron
{

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

    public static function initialize()
    {
        $command = '* * * * * php /var/www/faucet_rotator/artisan schedule:run 1>> /dev/null 2>&1';

        if (self::cronExists($command) == false) {
            //add job to crontab
            exec('echo -e "`crontab -l`\n'.$command.'" | crontab -');
        }
    }
}
