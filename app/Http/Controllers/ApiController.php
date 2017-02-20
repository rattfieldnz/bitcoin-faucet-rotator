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
    private $faucetCollection;

    public function __construct()
    {
        $this->faucetCollection = Faucet::all()->sortBy('interval_minutes')->values();
    }

    /**
     * A function used to retrieve all faucets currently stored on the system,
     * sorted by payout interval times.
     *
     * @return mixed
     */
    public function faucets()
    {
        return $this->faucetCollection->all();
    }

    /**
     * @param $id
     * @return array
     */
    public function faucet($id)
    {
        $faucet = Faucet::find($id);
        if ($faucet == null || !$faucet) {
            return [404 => 'Not Found'];
        }
        return $faucet;
    }

    /**
     * @return mixed
     */
    public function firstFaucet(){
        return $this->faucetCollection->get(0);
    }

    /**
     * @param $id
     * @return null
     */
    public function previousFaucet($id){
        $array = array_column($this->faucetCollection->toArray(), 'id');
        foreach($array as $key => $value){
            if($value == $id){
                // Decrement key to find previous one.
                if($key - 1 < 0){
                    // If subtracted value is negative,
                    // we are at beginning of faucet collection array.
                    // Go to last faucet in the collection.
                    return Faucet::find($array[count($array) - 1]);
                }
                return Faucet::find($array[$key - 1]);
            }
        }
        return null;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function nextFaucet($id){
        $array = array_column($this->faucetCollection->toArray(), 'id');
        foreach($array as $key => $value){
            if($value == $id){
                // Increase key to find next one.
                if($key + 1 > count($array) - 1){
                    // If addition is greater than number of faucets,
                    // We are at end of the collection.
                    // Go to first faucet in the collection.
                    return Faucet::find($array[0]);
                }
                return Faucet::find($array[$key + 1]);
            }
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function lastFaucet(){
        return $this->faucetCollection->get(count(Faucet::all()) - 1);
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
     * @param $id
     * @return array
     */
    public function paymentProcessorFaucet($paymentProcessorSlug, $faucetId)
    {
        //Obtain payment processor by related slug.
        $paymentProcessor = PaymentProcessor::where('slug', '=', $paymentProcessorSlug)->firstOrFail();

        // Use model relationship to obtain associated faucets
        $faucets = $paymentProcessor->faucets;
        $faucet = $faucets->where('id', '=', $faucetId)->first();
        if ($faucet == null || !$faucet) {
            return [404 => 'Not Found'];
        }
        return $faucet;
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
            $paymentProcessor = PaymentProcessor::where('slug', '=', $paymentProcessorSlug)->firstOrFail();

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

    public function firstPaymentProcessorFaucet($paymentProcessorSlug)
    {
        return $this->paymentProcessorFaucets($paymentProcessorSlug)[0];
    }

    public function previousPaymentProcessorFaucet($paymentProcessorSlug, $faucetId){
        //Obtain payment processor by related slug.
        $paymentProcessor = PaymentProcessor::where('slug', '=', $paymentProcessorSlug)->firstOrFail();

        // Use model relationship to obtain associated faucets
        $faucets = $paymentProcessor->faucets;

        $array = array_column($faucets->toArray(), 'id');
        foreach($array as $key => $value){
            if($value == $faucetId){
                // Increase key to find next one.
                if($key - 1 > count($array) - 1){
                    // If addition is greater than number of faucets,
                    // We are at end of the collection.
                    // Go to first faucet in the collection.
                    return Faucet::find($array[0]);
                }
                return Faucet::find($array[$key + 1]);
            }
        }
        return null;
    }

    public function nextPaymentProcessorFaucet($paymentProcessorSlug, $faucetId){
        //Obtain payment processor by related slug.
        $paymentProcessor = PaymentProcessor::where('slug', '=', $paymentProcessorSlug)->firstOrFail();

        // Use model relationship to obtain associated faucets
        $faucets = $paymentProcessor->faucets;

        $array = array_column($faucets->toArray(), 'id');
        foreach($array as $key => $value){
            if($value == $faucetId){
                // Increase key to find next one.
                if($key + 1 > count($array) - 1){
                    // If addition is greater than number of faucets,
                    // We are at end of the collection.
                    // Go to first faucet in the collection.
                    return Faucet::find($array[0]);
                }
                return Faucet::find($array[$key + 1]);
            }
        }
        return null;
    }

    public function lastPaymentProcessorFaucet($paymentProcessorSlug){

        $faucets = $this->paymentProcessorFaucets($paymentProcessorSlug);
        return $this->paymentProcessorFaucets($paymentProcessorSlug)[count($faucets) - 1];
    }

    public function activePaymentProcessorFaucets($paymentProcessorSlug, $hasLowBalance = false)
    {
        try {

            $activeFaucets = [];
            //Obtain payment processor by related slug.
            $paymentProcessor = PaymentProcessor::where('slug', '=', $paymentProcessorSlug)->first();

            // Use model relationship to obtain associated faucets
            $faucets = $paymentProcessor->faucets;

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
}
