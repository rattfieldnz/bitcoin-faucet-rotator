<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 02-Aug-2015
 * Time: 13:14
 */

namespace App\Helpers\Functions;


class LaravelCron
{

    public static function cronExists($command){

        $cronjob_exists = false;
        exec('crontab -l', $crontab);
        if(isset($crontab)&& is_array($crontab)){
            $crontab = array_flip($crontab);
            if(isset($crontab[$command])){
                $cronjob_exists = true;
            }
        }
        return $cronjob_exists;
    }

    public static function initialize(){
        $command = '* * * * * php /var/www/faucet_rotator/artisan schedule:run 1>> /dev/null 2>&1';

       if(self::cronExists($command) == false){
            //add job to crontab
            exec('echo -e "`crontab -l`\n'.$command.'" | crontab -');
       }
    }
}