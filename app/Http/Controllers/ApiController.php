<?php namespace App\Http\Controllers;

use App\Faucet;
use App\PaymentProcessor;
use Exception;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\Paginator;

class ApiController extends BaseController
{

    public function faucets()
    {
        return Faucet::all()->sortBy('interval_minutes')->values()->all();
    }

    public function faucet($slug)
    {
        $faucet = Faucet::find($slug);
        if ($faucet == null || !$faucet) {
            return [404 => 'Not Found'];
        }
        return $faucet;
    }

    public function activeFaucets($hasLowBalance = false)
    {

        try {
            $faucets = Faucet::all()->sortBy('interval_minutes')->values()->all();
            $activeFaucets = [];

            foreach ($faucets as $f) {
                if ($f->is_paused == false &&
                    $f->has_low_balance == $hasLowBalance) {
                    array_push($activeFaucets, $f);
                }
            }
            return $activeFaucets;
        } catch (Exception $e) {
            return null;
        }
    }

    public function paymentProcessorFaucets($paymentProcessorSlug)
    {

        try {
            $paymentProcessor = PaymentProcessor::findBySlugOrId($paymentProcessorSlug);

            $faucets = $paymentProcessor->faucets;

            $activeFaucets = [];

            foreach ($faucets as $f) {
                if ($f->is_paused == false &&
                    $f->has_low_balance == false
                ) {
                    array_push($activeFaucets, $f);
                }
            }
            return $activeFaucets;
        } catch (Exception $e) {
            return null;
        }
    }
}
