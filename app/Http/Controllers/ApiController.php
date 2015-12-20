<?php namespace App\Http\Controllers;

use App\Faucet;
use App\PaymentProcessor;
use Exception;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\Paginator;

/**
 * Class ApiController
 *
 * A controller class use to retrieve faucet-related data
 * in JSON format.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Http\Controllers
 */
class ApiController extends BaseController
{

    /**
     * A function used to retrieve all faucets currently stored on the system,
     * sorted by payout interval times.
     *
     * @return mixed
     */
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

    /**
     * A function to retrieve all active faucets.
     *
     * @param bool|false $hasLowBalance
     * @return array|null
     */
    public function activeFaucets($hasLowBalance = false)
    {

        try {
            //Get all faucets, regardless of low-balance or active/paused status.
            $faucets = Faucet::all()->sortBy('interval_minutes')->values()->all();
            $activeFaucets = [];

            //Iterate over all faucets, check their low-balance and active/pause status,
            //then put desired faucets in separate faucets array.
            foreach ($faucets as $f) {
                if ($f->is_paused == false &&
                    $f->has_low_balance == $hasLowBalance) {
                    array_push($activeFaucets, $f);
                }
            }

            //Return active faucets.
            return $activeFaucets;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * A function to retrieve all faucets associated with a
     * payment processor.
     *
     * @param $paymentProcessorSlug
     * @return array|null
     */
    public function paymentProcessorFaucets($paymentProcessorSlug)
    {

        try {
            //Obtain payment processor by related slug.
            $paymentProcessor = PaymentProcessor::findBySlug($paymentProcessorSlug);

            // Use model relationship to obtain associated faucets
            $faucets = $paymentProcessor->faucets;

            $activeFaucets = [];

            // Iterate over all related faucets,
            // obtaining only ones that are active.
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
