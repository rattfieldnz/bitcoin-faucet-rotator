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

    public function faucet($id){
        $faucet = Faucet::find($id);
        if($faucet == null || !$faucet){
            return [404 => 'Not Found'];
        }
        return $faucet;
    }
}