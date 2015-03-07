<?php namespace App\Http\Controllers;

use App\Faucet;
use App\Http\Requests;
use App\PaymentProcessor;
use Helpers\Transformers\FaucetTransformer;
use Illuminate\Http\Request;

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

}
