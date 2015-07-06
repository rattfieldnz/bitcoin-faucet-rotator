<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PaymentProcessor;
use Helpers\Transformers\PaymentProcessorTransformer;
use Helpers\Validators\PaymentProcessorValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PaymentProcessorsController extends Controller {

    function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $count_payment_processors = count(PaymentProcessor::all());
        $payment_processors = PaymentProcessor::paginate($count_payment_processors);

        return view('payment_processors.index', compact('payment_processors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $form_heading = "Add a new payment processor";
        $submit_button_text = "Submit Payment Processor";
        return view('payment_processors.create', compact(['form_heading', 'submit_button_text']));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), PaymentProcessorValidator::validationRulesNew());

        if($validator->fails()){
            return Redirect::to('payment_processors/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
        else{

            $payment_processor = new PaymentProcessor;

            $payment_processor->fill(Input::all());

            $payment_processor->save();

            Session::flash('success_message', 'The payment processor has successfully been created and stored!');
            return Redirect::to('/payment_processors/' . $payment_processor->id);
        }
	}

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Response
     * @internal param int $id
     */
	public function show($slug)
	{
        try {
            //$payment_processor = PaymentProcessor::findOrFail($id);
            $payment_processor = PaymentProcessor::findBySlugOrId($slug);

            return view('payment_processors.show', compact('payment_processor'));
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
            $payment_processor = PaymentProcessor::findOrFail($id);

            $submit_button_text = "Submit Changes";

            //Return the faucets edit view, with fields pre-populated.
            return view('payment_processors.edit', compact(['payment_processor', 'submit_button_text']));
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
		$payment_processor = PaymentProcessor::findOrFail($id);

        $validator = Validator::make(Input::all(), PaymentProcessorValidator::validationRulesEdit($id));

        if($validator->fails()){
            return Redirect::to('/payment_processors/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
        else{
            $payment_processor->fill(Input::all());

            $payment_processor->save();

            Session::flash('success_message', 'The payment processor has successfully been updated!');

            return Redirect::to('/payment_processors/' . $id);
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
            $payment_processor = PaymentProcessor::findOrFail($id);

            $payment_processor_name = $payment_processor->name;
            $payment_processor_url = $payment_processor->url;

            $payment_processor->faucets()->detach();
            $payment_processor->delete();

            Session::flash('success_message_delete', 'The payment processor "' . $payment_processor_name . '" with URL "' . $payment_processor_url . '" has successfully been deleted!');
            Session::flash('success_message_alert', 'Any faucets associated with the deleted payment processor will need to have another payment processor/s added to it.');
            return Redirect::to('/payment_processors/');
        }
        catch(ModelNotFoundException $e)
        {
            abort(404);
        }

	}

}
