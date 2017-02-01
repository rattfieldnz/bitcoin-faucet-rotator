<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PaymentProcessor;
use Exception;
use Helpers\Transformers\PaymentProcessorTransformer;
use Helpers\Validators\PaymentProcessorValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * Class PaymentProcessorsController
 *
 * A controller class to handle REST interaction for
 * payment processors.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Http\Controllers
 */
class PaymentProcessorsController extends Controller
{

    /**
     * PaymentProcessorsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'faucets']]);
    }
    /**
     * Display a listing of all current payment processors.
     *
     * @todo Decide whether to use pagination or not.
     * @return Response
     */
    public function index()
    {
        $countPaymentProcessors = count(PaymentProcessor::all());
        $paymentProcessors = PaymentProcessor::paginate($countPaymentProcessors);

        return view('payment_processors.index', compact('paymentProcessors'));
    }

    /**
     * Show the form for creating a new payment processor.
     *
     * @return Response
     */
    public function create()
    {
        $submitButtonText = "Submit Payment Processor";
        return view('payment_processors.create', compact('submitButtonText'));
    }

    /**
     * Store a newly created payment processor in storage.
     *
     * @return Response
     */
    public function store()
    {
        //Validate form input used for creating payment processor.
        $validator = Validator::make(Input::all(), PaymentProcessorValidator::validationRulesNew());

        // Redirect to pre-populated form if validation failed.
        if ($validator->fails()) {
            return Redirect::to('/admin/payment_processors/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        }

        // If validation passes, use form data to store
        // payment processor.
        $paymentProcessor = new PaymentProcessor;

        $paymentProcessor->fill(Input::all());

        $paymentProcessor->save();

        Session::flash('success_message', 'The payment processor has successfully been created and stored!');
        return Redirect::to('/payment_processors/' . $paymentProcessor->slug);
    }

    /**
     * Display the specified payment processor.
     *
     * @param $slug
     * @return Response
     */
    public function show($slug)
    {
        try {
            $paymentProcessor = PaymentProcessor::findBySlug($slug);

            return view('payment_processors.show', compact('paymentProcessor', 'slug'));
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Show the form for editing a payment processor.
     *
     * @param $slug
     * @return Response
     */
    public function edit($slug)
    {
        try {
            $paymentProcessor = PaymentProcessor::findBySlugOrId($slug);

            $submitButtonText = "Submit Changes";

            //Return the faucets edit view, with fields pre-populated.
            return view('payment_processors.edit', compact('paymentProcessor', 'submitButtonText'));
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Update the specified payment processor in storage.
     *
     * @param $slug
     * @return Response
     */
    public function update($slug)
    {
        // Obtain payment processor tp update
        $paymentProcessor = PaymentProcessor::findBySlug($slug);
        $id = $paymentProcessor->id;

        // Create validator to validate form data used to update payment processor.
        $validator = Validator::make(Input::all(), PaymentProcessorValidator::validationRulesEdit($id));

        // If validation fails, redirect to pre-populated form.
        if ($validator->fails()) {
            return Redirect::to('/admin/payment_processors/' . $slug . '/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        }

        // If validation passes, store updated details for
        // payment processor into database.
        $paymentProcessor->fill(Input::all());

        $paymentProcessor->save();

        Session::flash('success_message', 'The payment processor has successfully been updated!');

        return Redirect::to('/payment_processors/' . $slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return Response
     */
    public function destroy($slug)
    {
        try {
            $paymentProcessor = PaymentProcessor::findBySlugOrId($slug);

            $paymentProcessorName = $paymentProcessor->name;
            $paymentProcessorUrl = $paymentProcessor->url;

            $paymentProcessor->faucets()->detach();
            $paymentProcessor->delete();

            Session::flash(
                'success_message_delete',
                'The payment processor "' . $paymentProcessorName .
                '" with URL "' . $paymentProcessorUrl .
                '" has successfully been deleted!'
            );
            Session::flash(
                'success_message_alert',
                'Any faucets associated with the deleted payment processor' .
                ' will need to have another payment processor/s added to it.'
            );
            return Redirect::to('/payment_processors/');
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function faucets($paymentProcessorSlug)
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
            return view(
                'payment_processors.rotator.index',
                compact('paymentProcessor', 'activeFaucets', 'paymentProcessorSlug')
            );
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }
}
