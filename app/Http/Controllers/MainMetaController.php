<?php namespace App\Http\Controllers;

use app\Helpers\Validators\MainMetaValidator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


use App\MainMeta;
use Illuminate\Http\Request;

class MainMetaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$main_meta = MainMeta::all();

        if(count($main_meta) == 0) {
            return view('main_meta.create');
        }
        else{
            $main_meta = MainMeta::first();
            return view('main_meta.edit', compact('main_meta'));
        }

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        //Create the validator to process input for validation.
        $validator = Validator::make(Input::all(), MainMetaValidator::validationRulesNew());

        if($validator->fails()){
            return Redirect::to('faucets/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
        else{
            $main_meta = new MainMeta();

            $main_meta->fill(Input::all());

            $main_meta->save();

            Session::flash('success_message', 'The main meta has successfully been created and stored!');

            return Redirect::to('/main_meta');
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
		//
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

}
