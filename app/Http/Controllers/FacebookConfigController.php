<?php

namespace App\Http\Controllers;

use App\FacebookConfig;
use App\User;
use Helpers\Validators\FacebookConfigValidator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FacebookConfigController extends Controller
{
    function __construct()   {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facebookConfig = User::find(Auth::user()->id)->facebookConfig;

        if(count($facebookConfig) == 0) {
            return view('facebook_config.create');
        }
        else{
            return view('facebook_config.edit', compact('facebookConfig'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //Create the validator to process input for validation.
        $input = Input::except('_token');
        $validator = Validator::make($input, FacebookConfigValidator::validationRules());

        if($validator->fails()){
            return Redirect::to('/admin/facebook_config')
                ->withErrors($validator)
                ->withInput($input);
        }
        else{
            $facebookConfig = new FacebookConfig();
            $facebookConfig->fill($input);

            $facebookConfig->save();

            Session::flash('success_message_add', 'The Facebook configuration has successfully been created and stored!');

            return Redirect::to('/admin/facebook_config');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FacebookConfig $facebookConfig
     * @return \Illuminate\Http\Response
     */
    public function update(FacebookConfig $facebookConfig)
    {
        $facebookConfig = $facebookConfig::firstOrFail();
        $input = Input::except('_token');
        $validator = Validator::make($input, FacebookConfigValidator::validationRules());

        if($validator->fails()){
            return Redirect::to('admin/facebook_config')
                ->withErrors($validator)
                ->withInput($input);
        }
        else{
            //die(var_dump($input));
            $facebookConfig->fill($input);

            $facebookConfig->save();

            Session::flash('success_message_update', 'The Facebook configuration has successfully been updated!');

            return Redirect::to('admin/facebook_config');

        }
    }
}
