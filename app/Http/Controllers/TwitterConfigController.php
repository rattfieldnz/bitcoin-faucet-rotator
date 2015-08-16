<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TwitterConfig;
use App\User;
use Helpers\Validators\TwitterConfigValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TwitterConfigController extends Controller {

    function __construct()   {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $twitterConfig = User::find(Auth::user()->id)->twitterConfig;

        if(!$twitterConfig || count($twitterConfig) == 0) {
            return view('twitter_config.create');
        }
        else{
            return view('twitter_config.edit', compact('twitterConfig'));
        }
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
	    //Create the validator to process input for validation.
        $input = Input::except('_token');
        $validator = Validator::make($input, TwitterConfigValidator::validationRulesNew());

        if($validator->fails()){
            return Redirect::to('admin/twitter_config')
                ->withErrors($validator)
                ->withInput($input);
        }
        else{
            //var_dump($input);

            $twitterConfig = new TwitterConfig();
            $twitterConfig->fill($input);

            $twitterConfig->save();

            Session::flash('success_message_add', 'The Twitter configuration has successfully been created and stored!');

            return Redirect::to('admin/twitter_config');
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

    /**
     * Update the specified resource in storage.
     *
     * @param TwitterConfig $twitterConfig
     * @return Response
     */
    public function update(TwitterConfig $twitterConfig)
    {

        $input = Input::except('_token');
        $validator = Validator::make($input, TwitterConfigValidator::validationRulesEdit($twitterConfig->id));

        if($validator->fails()){
            return Redirect::to('admin/twitter_config')
                ->withErrors($validator)
                ->withInput($input);
        }
        else{
            $twitterConfig->fill($input);

            $twitterConfig->save();

            Session::flash('success_message_update', 'The Twitter configuration has successfully been updated!');

            return Redirect::to('admin/twitter_config');

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
		//
	}

}
