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

    /**
     * ApiController constructor.
     */
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
        $faucets = collect();
        $faucetCollection = $this->faucetCollection->all();
        for($i = 0; $i < count($faucetCollection); $i++){
            $faucet = Faucet::with('keywords')->findOrFail($faucetCollection[$i]->id);
            $faucets->push($faucet);
        }
        return $faucets;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function faucet($id)
    {
        $faucet = Faucet::with('keywords')->findOrFail($id);
        if ($faucet == null || !$faucet) {
            return [404 => 'Not Found'];
        }
        return $faucet;
    }

    /**
     * @return mixed
     */
    public function firstFaucet(){
        return $this->faucets()[0];
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
                    return Faucet::with('keywords')->findOrFail($array[count($array) - 1]);
                }
                return Faucet::with('keywords')->findOrFail($array[$key - 1]);
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
                    return Faucet::with('keywords')->findOrFail($array[0]);
                }
                return Faucet::with('keywords')->findOrFail($array[$key + 1]);
            }
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function lastFaucet(){
        return $this->faucets()[count(Faucet::all()) - 1];
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
                    array_push($activeFaucets, $this->faucet($f->id));
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
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
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
        return $this->faucet($faucet->id);
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
                    array_push($activeFaucets, $this->faucet($f->id));
                }
            }
            return $activeFaucets;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param $paymentProcessorSlug
     * @return mixed
     */
    public function firstPaymentProcessorFaucet($paymentProcessorSlug)
    {
        return $this->paymentProcessorFaucets($paymentProcessorSlug)[0];
    }

    /**
     * @param $paymentProcessorSlug
     * @param $faucetId
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
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
                    return Faucet::with('keywords')->findOrFail($array[0]);
                }
                return Faucet::with('keywords')->findOrFail($array[$key + 1]);
            }
        }
        return null;
    }

    /**
     * @param $paymentProcessorSlug
     * @param $faucetId
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
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
                    return Faucet::with('keywords')->findOrFail($array[0]);
                }
                return Faucet::with('keywords')->findOrFail($array[$key + 1]);
            }
        }
        return null;
    }

    /**
     * @param $paymentProcessorSlug
     * @return mixed
     */
    public function lastPaymentProcessorFaucet($paymentProcessorSlug){

        $faucets = $this->paymentProcessorFaucets($paymentProcessorSlug);
        return $this->paymentProcessorFaucets($paymentProcessorSlug)[count($faucets) - 1];
    }

    /**
     * @param $paymentProcessorSlug
     * @param bool $hasLowBalance
     * @return array|null
     */
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
                    array_push($activeFaucets, $this->faucet($f->id));
                }
            }

            //Return active faucets.
            return $activeFaucets;
        } catch (Exception $e) {
            return null;
        }
    }
}
