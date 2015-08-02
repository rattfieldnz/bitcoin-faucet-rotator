<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 02-Aug-2015
 * Time: 13:57
 */

namespace App\Helpers\Functions;


use App\Faucet;
use Illuminate\Support\Facades\Session;
use RattfieldNz\UrlValidation\UrlValidation;

class Faucets
{
    public static function checkUpdateStatuses(){
        //Retrieve faucets to be updated.
        $faucets = Faucet::all();

        $paused_faucets = [];
        $activated_faucets = [];
        foreach($faucets as $f){

            if(UrlValidation::urlExists($f->url) != true && $f->is_paused == false){
                $f->is_paused = true;
                $f->save();
                array_push($paused_faucets, $f->name);
            }
            else if(UrlValidation::urlExists($f->url) != false && $f->is_paused == true){
                $f->is_paused = false;
                $f->save();
                array_push($activated_faucets, $f->name);
            }
        }

        if(count($paused_faucets) == 0 && count($activated_faucets) == 0){
            Session::flash('success_message_update_faucet_statuses_none', 'No faucets have been updated.');
        }
        else {
            if (count($paused_faucets) > 0) {
                Session::flash(
                    'success_message_update_faucet_statuses_paused',
                    'The following faucets have been paused: ' . implode(",", $paused_faucets)
                );
            }
            if (count($activated_faucets) > 0) {
                Session::flash(
                    'success_message_update_faucet_statuses_activated',
                    'The following faucets have been activated: ' . implode(",", $activated_faucets)
                );
            }
        }
    }
}