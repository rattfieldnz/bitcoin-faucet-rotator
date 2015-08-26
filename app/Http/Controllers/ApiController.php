<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 28-Jun-2015
 * Time: 15:09
 */

namespace App\Http\Controllers;

use App\Faucet;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\Paginator;

class ApiController extends BaseController{

    public function faucets(){
        return Faucet::all();
    }

    public function faucet($slug){
        $faucet = Faucet::find($slug);
        if($faucet == null || !$faucet){
            return [404 => 'Not Found'];
        }
        return $faucet;
    }

    public function activeFaucets($has_low_balance = false){
        $faucets = Faucet::all();
        $active_faucets = [];

        foreach($faucets as $f){
            if($f->is_paused == false &&
                $f->has_low_balance == $has_low_balance){
                array_push($active_faucets, $f);
            }
        }

        return $active_faucets;
    }
}