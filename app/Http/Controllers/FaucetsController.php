<?php namespace App\Http\Controllers;

use App\Faucet;
use App\Http\Requests;
use App\PaymentProcessor;
use App\User;
use Helpers\Validators\FaucetValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FaucetsController extends Controller {

    function __construct()   {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Auth::user())
        {
            $faucets_user_id = Auth::user()->id;
        }
        else {
            $faucets_user_id = (int)User::where('is_admin', '=', true)->firstOrFail()->id;
        }

        $faucets = User::find($faucets_user_id)->faucets;
        return view('faucets.index', compact('faucets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $payment_processors = PaymentProcessor::lists('name', 'id');
        $form_heading = "Create a new faucet";
        $submit_button_text = "Submit Faucet";
        return view('faucets.create', compact(['payment_processors', 'form_heading', 'submit_button_text']));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
	public function store()
	{
        //Create the validator to process input for validation.
		$validator = Validator::make(Input::all(), FaucetValidator::validationRulesNew());

        //If validator fails, return to the create page -
        //with input still in form, and accompanied with
        //the relevant errors.
        if($validator->fails()){
            return Redirect::to('faucets/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            //Declare and instantiate a new faucet.
            $faucet = new Faucet;

            //Assign input from the form to the faucet's properties -
            //except payment processors as this needs to be done separately.
            $faucet->fill(Input::except('faucet_payment_processors'));

            //Retrieve payment processor ids from multi-select dropdown
            $payment_processor_ids = Input::get('faucet_payment_processors');

            //Save the faucet, with the filled-in data.
            $faucet->save();

            //Now we have saved a faucet, we can begin inserting associated
            //payment processors from input - in a many-many relationship.
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            foreach ($payment_processor_ids as $payment_processor_id) {
                $faucet->payment_processors()->attach((int)$payment_processor_id);
            }

            //Associated the currently logged in user with the new faucet.
            $faucet->users()->attach(Auth::user()->id);

            // Re-enable foreign key checks after inserting
            //many-many records.
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');

            //Redirect to the faucet's page, with a success message.
            Session::flash('success_message', 'The faucet has successfully been created and stored!');
            return Redirect::to('/faucets/' . $faucet->id);
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        try {
            //Retrieve faucet by given id.
            $faucet = Faucet::findOrFail($id);

            //Return the view which shows faucet details,
            //with the retrieved faucet bring passe in the view.
            return view('faucets.show', compact('faucet'));
        }
        catch(ModelNotFoundException $e)
        {
            abort(404);
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        try {
            //Grab the faucet to edit
            $faucet = Faucet::findOrFail($id);

            //Obtain payment processors associated with the faucet.
            $payment_processors = PaymentProcessor::lists('name', 'id');
            $faucet_payment_processors = $faucet->payment_processors;

            //Retrieve ids of associated payment processors,
            //and putting them into an array.
            $payment_processor_ids = array();
            foreach ($faucet_payment_processors as $payment_processor) {
                array_push($payment_processor_ids, (int)$payment_processor->id);
            }

            $submit_button_text = "Submit Changes";

            //Return the faucets edit view, with fields pre-populated.
            return view('faucets.edit', compact(['faucet',
                'payment_processors',
                'payment_processor_ids',
                'submit_button_text']));
        }
        catch(ModelNotFoundException $e)
        {
            abort(404);
        }
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        //Retrieve faucet to be updated.
        $faucet = Faucet::findOrFail($id);

        //Pass input into the validator -
        //with current faucet id, so
        //'not unique' errors won't be displayed
        //when updating.
        $validator = Validator::make(Input::all(), FaucetValidator::validationRulesEdit($id));

        //If validation fails, redirect back to the
        //editing page - with input and relevant errors.
        if($validator->fails()){
            return Redirect::to('faucets/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            //Get all input from edit/update request,
            //then populate the faucet with the given
            //data.
            $faucet->fill(Input::all());

            //Retrieve payment processor ids from update.
            $payment_processor_ids = Input::get('faucet_payment_processors');

            //Below logic disables foreign key checking before
            //updating many-to-many table (faucet_payment_processor)
            //that ties instances of faucets to instances of payment
            //processors. The retrieved payment processor ids are
            //iterated through, then synced with the current faucet in
            // the many-many table. Then foreign key checking is re-enabled.
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            $faucet->payment_processors()->detach();
            foreach ($payment_processor_ids as $payment_processor_id) {
                $faucet->payment_processors()->attach((int)$payment_processor_id);
            }
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');

            //Save the changes made to the faucet.
            $faucet->save();

            Session::flash('success_message', 'The faucet has successfully been updated!');

            //Redirect to the faucet's page
            return Redirect::to('/faucets/' . $id);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        try {
            $faucet = Faucet::findOrFail($id);
            $faucet_name = $faucet->name;
            $faucet_url = $faucet->url;
            $faucet->payment_processors()->detach();
            $faucet->users()->detach();
            $faucet->delete();

            Session::flash('success_message_delete', 'The faucet "' . $faucet_name . '" with URL "' . $faucet_url . '" has successfully been deleted!');

            return Redirect::to('/faucets/');
        }
        catch(ModelNotFoundException $e)
        {
            abort(404);
        }
	}

}
