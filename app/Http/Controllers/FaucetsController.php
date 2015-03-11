<?php namespace App\Http\Controllers;

use App\Faucet;
use App\Http\Requests;
use App\PaymentProcessor;
use Helpers\Transformers\FaucetTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FaucetsController extends Controller {

    protected $faucetTransformer;

    function __construct(FaucetTransformer $transformer)   {
        $this->faucetTransformer = $transformer;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $count_faucets = count(Faucet::all());
		$faucets = Faucet::paginate($count_faucets);

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
		//https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers

        $validation_rules = [
            'name' => 'required|unique:faucets,name|min:10',
            'url' => 'required|unique:faucets,url',
            'interval_minutes' => 'required|integer',
            'min_payout' => 'required|numeric',
            'max_payout' => 'required|numeric',
            'faucet_payment_processors[]' => 'each:exists,faucet_payment_processors, id',
            'has_ref_program' => 'required|boolean',
            'ref_payout_percent' => 'required|numeric|between:0,100',
            'comments' => 'text',
            'is_paused' => 'required|boolean'
        ];

        $validator = Validator::make(Input::all(), $validation_rules);

        if($validator->fails()){
            return Redirect::to('faucets/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $faucet = new Faucet;
            $faucet->name = Input::get('name');
            $faucet->url = Input::get('url');
            $faucet->interval_minutes = Input::get('interval_minutes');
            $faucet->min_payout = Input::get('min_payout');
            $faucet->max_payout = Input::get('max_payout');
            $faucet->has_ref_program = Input::get('has_ref_program');
            $faucet->ref_payout_percent = Input::get('ref_payout_percent');
            $faucet->comments = Input::get('comments');
            $faucet->is_paused = Input::get('is_paused');

            $payment_processor_ids = Input::get('faucet_payment_processors');

            $faucet->save();

            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            foreach ($payment_processor_ids as $payment_processor_id) {
                $faucet->payment_processors()->attach((int)$payment_processor_id);
            }

            $faucet->users()->attach(Auth::user()->id);

            DB::statement('SET FOREIGN_KEY_CHECKS = 1');

            //Redirect to the faucet's page
            Session::flash('message', 'The faucet has successfully been created and stored!');
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
        $faucet = Faucet::findOrFail($id);

        return view('faucets.show', compact('faucet'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        //Grab the faucet to edit
        $faucet = Faucet::findOrFail($id);

        //Obtain payment processors associated with the faucet.
        $payment_processors = PaymentProcessor::lists('name', 'id');
        $faucet_payment_processors = $faucet->payment_processors;

        //Retrieve ids of associated payment processors,
        //and putting them into an array.
        $payment_processor_ids = array();
        foreach($faucet_payment_processors as $payment_processor)
        {
            array_push($payment_processor_ids, (int)$payment_processor->id);
        }

        $submit_button_text = "Submit Changes";

        //Return the faucets edit view, with fields pre-populated.
        return view('faucets.edit', compact(['faucet',
                                             'payment_processors',
                                             'payment_processor_ids',
                                             'submit_button_text']));
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

        //Get all input from edit/update request,
        //then populate th faucet with the given
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
        foreach($payment_processor_ids as $payment_processor_id)
        {
            $faucet->payment_processors()->attach((int)$payment_processor_id);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        //Save the changes made to the faucet.
        $faucet->save();

        //Redirect to the faucet's page
        return Redirect::to('/faucets/' . $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
