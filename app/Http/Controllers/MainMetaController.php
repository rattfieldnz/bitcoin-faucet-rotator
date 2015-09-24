<?php namespace App\Http\Controllers;

use app\Helpers\Validators\MainMetaValidator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Chromabits\Purifier\Contracts\Purifier;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


use App\MainMeta;
use Illuminate\Http\Request;

class MainMetaController extends Controller {
    /**
     * @var Purifier
     */
    protected $purifier;

    function __construct(Purifier $purifier)   {
        $this->middleware('auth');
        $this->purifier = $purifier;
    }
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
        $input = Input::except('_token', 'page_main_content');
        $main_content = $this->purifier->clean(Input::get('page_main_content'));
        $input['page_main_content'] = $main_content;

        $validator = Validator::make($input, MainMetaValidator::validationRules());

        if($validator->fails()){
            return Redirect::to('/admin/main_meta')
                ->withErrors($validator)
                ->withInput($input);
        }
        else{
            $main_meta = new MainMeta();
            $main_meta->fill($input);

            $main_meta->save();

            Session::flash('success_message_add', 'The main meta has successfully been created and stored!');

            return Redirect::to('/admin/main_meta');
        }
	}

    /**
     * Update the specified resource in storage.
     *
     * @param MainMeta $main_meta
     * @return Response
     * @internal param int $id
     */
	public function update(MainMeta $main_meta)
	{
        $main_meta = $main_meta::firstOrFail();

        $input = Input::except('_token');
        $validator = Validator::make($input, MainMetaValidator::validationRules());

        if($validator->fails()){
            return Redirect::to('/admin/main_meta')
                ->withErrors($validator)
                ->withInput($input);
        }
        else{
            $main_meta->fill($input);

            $main_meta->save();

            Session::flash('success_message_update', 'The main meta has successfully been updated!');

            return Redirect::to('/admin/main_meta/');

        }
	}

}
