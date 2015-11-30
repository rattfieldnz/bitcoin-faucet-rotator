<?php namespace App\Helpers\Functions;

use App\Faucet;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use RattfieldNz\UrlValidation\UrlValidation;

/**
 * Class Faucets
 *
 * A helper class to handle extra funtionality
 * related to currently stored faucets.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Helpers\Functions
 */
class Faucets
{
    /**
     * A function to update a faucet's status (active or paused)
     * according to their low-balance status and if the
     * faucet's URL is error-free and valid.
     */
    public static function checkUpdateStatuses()
    {
        //Retrieve faucets to be updated.
        $faucets = Faucet::all();

        $pausedFaucets = [];
        $activatedFaucets = [];
        foreach ($faucets as $f) {
            if (UrlValidation::urlExists($f->url) != true &&
                $f->is_paused == false &&
                $f->has_low_balance == false) {
                    $f->is_paused = true;
                    $f->save();
                    array_push($pausedFaucets, $f->name);
            } elseif (UrlValidation::urlExists($f->url) != false &&
                $f->is_paused == true &&
                $f->has_low_balance == false) {
                    $f->is_paused = false;
                    $f->save();
                    array_push($activatedFaucets, $f->name);
            }
        }

        if (count($pausedFaucets) == 0 && count($activatedFaucets) == 0) {
            Session::flash('success_message_update_faucet_statuses_none', 'No faucets have been updated.');
        }
        if (count($pausedFaucets) > 0) {
            Session::flash(
                'success_message_update_faucet_statuses_paused',
                'The following faucets have been paused: ' . implode(",", $pausedFaucets)
            );
        }
        if (count($activatedFaucets) > 0) {
            Session::flash(
                'success_message_update_faucet_statuses_activated',
                'The following faucets have been activated: ' . implode(",", $activatedFaucets)
            );
        }
    }

    /**
     * A function used to update the 'low balance' status of a
     * faucet.
     *
     * @param $faucetSlug
     * @return mixed
     */
    public static function lowBalance($faucetSlug)
    {
        try {
            $lowBalanceStatus = Input::get('has_low_balance');
            $faucet = Faucet::findBySlugOrId($faucetSlug);
            $faucet->has_low_balance = $lowBalanceStatus;
            $faucet->save();

            Session::flash(
                'success_message_update_faucet_low_balance_status',
                'The faucet has been paused due to low balance (less than 10,000 Satoshis).'
            );

            return Redirect::to('faucets/' . $faucetSlug);
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (Exception $e) {
            return Redirect::to('faucets/' . $faucetSlug)
                ->withErrors(['There was a problem changing low balance status, please try again.'])
                ->withInput(Input::get('has_low_balance'));

        }
    }
}
