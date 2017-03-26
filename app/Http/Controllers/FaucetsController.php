<?php namespace App\Http\Controllers;

use App\Faucet;
use App\Helpers\Functions\Faucets;
use App\Helpers\Social\Twitter;
use App\Http\Requests;
use App\PaymentProcessor;
use App\User;
use Exception;
use Helpers\Validators\FaucetValidator;
use Http\Controllers\IController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;
use RattfieldNz\UrlValidation\UrlValidation;

/**
 * Class FaucetsController
 *
 * A controller class for handling REST interaction
 * related to faucets.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Http\Controllers
 */
class FaucetsController extends Controller implements IController
{

    private $faucetsUserId;

    /**
     * FaucetsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of all faucets currently in the system.
     *
     * @return Response
     */
    public function index()
    {
        //Obtain faucets of logged in user
        if (Auth::user()) {
            $this->faucetsUserId = Auth::user()->id;
        }
        $this->faucetsUserId = (int)User::where('is_admin', '=', true)->firstOrFail()->id;

        // Use model relationship to retrieve faucets by User.
        $faucets = User::find($this->faucetsUserId)->faucets;

        // Return the page with list of faucets.
        return view('faucets.index', compact('faucets'));
    }

    /**
     * Show the form for creating a new faucet.
     *
     * @return Response
     */
    public function create()
    {
        // Obtain current payment processors stored, from which
        // a faucet can be associated with.
        $paymentProcessors = PaymentProcessor::orderBy('name', 'asc');
        //dd($paymentProcessors);
        $paymentProcessorIds = null;
        $formHeading = "Create a new faucet";
        $submitButtonText = "Submit Faucet";

        // Return the form for which a faucet can be added.
        return view('faucets.create', compact('paymentProcessors','paymentProcessorIds', 'formHeading', 'submitButtonText'));
    }

    /**
     * Store a newly created faucet in storage.
     *
     * @return Response
     * @internal param Request $request
     */
    public function store()
    {
        //Create the validator to process input for validation.
        $validator = Validator::make(self::cleanInput(Input::except('send_tweet')), FaucetValidator::validationRulesNew());

        //If validator fails, return to the create page -
        //with input still in form, and accompanied with
        //the relevant errors.
        if ($validator->fails()) {
            return Redirect::to('/admin/faucets/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
        //Declare and instantiate a new faucet.
        $faucet = new Faucet;

        $input = self::cleanInput(Input::except('payment_processors', 'send_tweet'));
        //Assign input from the form to the faucet's properties -
        //except payment processors as this needs to be done separately.
        $faucet->fill($input);

        //Retrieve payment processor ids from multi-select dropdown
        $paymentProcessorIds = Input::get('payment_processors');

        //Save the faucet, with the filled-in data.
        $faucet->save();

        //Now we have saved a faucet, we can begin inserting associated
        //payment processors from input - in a many-many relationship.
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        if(count($paymentProcessorIds) >= 1){
            $faucet->paymentProcessors->sync($paymentProcessorIds);
        }

        //Associated the currently logged in user with the new faucet.
        $faucet->users()->attach(Auth::user()->id);

        // Re-enable foreign key checks after inserting
        //many-many records.
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        //Redirect to the faucet's page, with a success message.
        Session::flash('success_message', 'The faucet has successfully been created and stored!');

        if (self::cleanInput(Input::get('send_tweet')) == 1) {
            $faucetUrl = url('/faucets/' . $faucet->slug);

            $user = User::find(Auth::user()->id);
            $twitter = new Twitter($user);

            $twitter->sendTweet(
                "Hey everyone, just added another #Bitcoin faucet @ " . $faucetUrl .
                ". Check it out now! #FreeBTCWebsite"
            );
        }

        return Redirect::to('/faucets/' . $faucet->slug);
    }

    /**
     * Display the specified faucet.
     *
     * @param $slug
     * @return Response
     * @internal param int $id
     */
    public function show($slug)
    {
        try {
            //Retrieve faucet by given id.
            //$faucet = Faucet::findOrFail($slug);
            $faucet = Faucet::where('slug', '=', $slug)->firstOrFail();
            
            if (!$faucet) {
                return response(view('errors.404'), 404);
            }

            //Return the view which shows faucet details,
            //with the retrieved faucet bring passe in the view.
            return view('faucets.show', compact('faucet', 'slug'));
        } catch (ModelNotFoundException $e) {
            return response(view('errors.404'), 404);
        }
    }

    /**
     * Show the form for editing the specified faucet.
     *
     * @param $slug
     * @return Response
     */
    public function edit($slug)
    {
        try {
            //Grab the faucet to edit
            $faucet = Faucet::where('slug', '=', $slug)->firstOrFail();

            //Obtain payment processors associated with the faucet.
            $paymentProcessors = PaymentProcessor::orderBy('name', 'asc')->get();

            //Retrieve ids of associated payment processors,
            //and putting them into an array.
            $paymentProcessorIds = [];

            foreach($faucet->paymentProcessors->pluck('id')->toArray() as $key => $value){
                array_push($paymentProcessorIds, $value);
            }

            $submitButtonText = "Submit Changes";

            //Return the faucets edit view, with fields pre-populated.
            return view(
                'faucets.edit',
                compact(
                    'faucet',
                    'paymentProcessors',
                    'paymentProcessorIds',
                    'submitButtonText'
                )
            );
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Update the specified faucet in storage.
     *
     * @param $slug
     * @return Response
     * @internal param int $id
     */
    public function update($slug)
    {
        //Retrieve faucet to be updated.
        $faucet = Faucet::where('slug', '=', $slug)->firstOrFail();
        $id = $faucet->id;

        //Pass input into the validator -
        //with current faucet id, so
        //'not unique' errors won't be displayed
        //when updating.
        $input = self::cleanInput(Input::except('send_tweet'));
        $validator = Validator::make($input, FaucetValidator::validationRulesEdit($id));

        //If validation fails, redirect back to the
        //editing page - with input and relevant errors.
        if ($validator->fails()) {
            return Redirect::to('/admin/faucets/' . $slug . '/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
        //Get all input from edit/update request,
        //then populate the faucet with the given
        //data.
        $faucet->fill($input);

        $paymentProcessorIds = Input::get('payment_processors');
        $paymentProcessors = PaymentProcessor::whereIn('id', $paymentProcessorIds);

        $toAddPaymentProcressorIds = [];

        foreach($paymentProcessors->pluck('id')->toArray() as $key => $value){
            array_push($toAddPaymentProcressorIds, (int)$value);
        }

        //Below logic disables foreign key checking before
        //updating many-to-many table (faucet_payment_processor)
        //that ties instances of faucets to instances of payment
        //processors. The retrieved payment processor ids are
        //iterated through, then synced with the current faucet in
        // the many-many table. Then foreign key checking is re-enabled.
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        if(count($toAddPaymentProcressorIds) >= 1){
            $faucet->paymentProcessors->sync($toAddPaymentProcressorIds);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        //Save the changes made to the faucet.
        $faucet->save();

        if (Input::get('send_tweet') == 1) {
            $faucetUrl = url('/faucets/' . $faucet->slug);

            $user = User::find(Auth::user()->id);
            $twitter = new Twitter($user);

            $twitter->sendTweet(
                "Hey everyone! Just updated #Bitcoin faucet (" . $faucet->name . ") @ " . $faucetUrl .
                " #FreeBTCWebsite"
            );
        }

        Session::flash('success_message', 'The faucet has successfully been updated!');

        //Redirect to the faucet's page
        return Redirect::to('/faucets/' . $slug);
    }

    /**
     * Remove the specified faucet from storage.
     *
     * @param $slug
     * @return Response
     * @internal param int $id
     */
    public function destroy($slug)
    {
        try {
            $faucet = Faucet::where('slug', '=', $slug)->firstOrFail();
            $faucetName = $faucet->name;
            $faucetUrl = $faucet->url;
            $faucet->paymentProcessors()->detach();
            $faucet->users()->detach();
            $faucet->delete();

            Session::flash(
                'success_message_delete',
                'The faucet "' . $faucetName . '" with URL "' .
                $faucetUrl . '" has successfully been deleted!'
            );

            return Redirect::to('faucets');
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function checkFaucetsStatus()
    {

        Faucets::checkUpdateStatuses();
        return Redirect::to('faucets');
    }

    public function faucetLowBalance($slug)
    {
        Faucets::lowBalance($slug);
    }

    /**
     * @param array $input
     * @return array
     */
    static function cleanInput(array $input)
    {
        $input['name'] = Purifier::clean($input['name'], 'generalFields');
        $input['url'] = Purifier::clean($input['url'], 'generalFields');
        $input['interval_minutes'] = Purifier::clean($input['interval_minutes'], 'generalFields');
        $input['min_payout'] = Purifier::clean($input['min_payout'], 'generalFields');
        $input['max_payout'] = Purifier::clean($input['max_payout'], 'generalFields');
        $input['has_ref_program'] = Purifier::clean($input['has_ref_program'], 'generalFields');
        $input['ref_payout_percent'] = Purifier::clean($input['ref_payout_percent'], 'generalFields');
        $input['comments'] = Purifier::clean($input['comments'], 'generalFields');
        $input['is_paused'] = Purifier::clean($input['is_paused'], 'generalFields');
        $input['meta_title'] = Purifier::clean($input['meta_title'], 'generalFields');
        $input['meta_description'] = Purifier::clean($input['meta_description'], 'generalFields');
        $input['meta_keywords'] = Purifier::clean($input['meta_keywords'], 'generalFields');
        $input['has_low_balance'] = Purifier::clean($input['has_low_balance'], 'generalFields');

        return $input;
    }
}
