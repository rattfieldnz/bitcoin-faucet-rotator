<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PaymentProcessor;
use Helpers\Transformers\PaymentProcessorTransformer;
use Illuminate\Http\Request;

class PaymentProcessorsController extends Controller {

    protected $paymentProcessorTransformer;

    function __construct(PaymentProcessorTransformer $transformer)
    {
        $this->paymentProcessorTransformer = $transformer;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$payment_processors = PaymentProcessor::all();

        return $this->paymentProcessorTransformer->transformCollection($payment_processors->all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $faucet = PaymentProcessor::findOrFail($id);

        return $this->paymentProcessorTransformer->transform($faucet);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

    private function transformCollection($payment_processors)
    {
        return array_map([$this, 'transform'], $payment_processors->toArray());
    }

    private function transform($payment_processor)
    {
        return [
            'id' => (int)$payment_processor['id'],
            'name' => $payment_processor['name'],
            'url' => $payment_processor['url']
        ];
    }

}
