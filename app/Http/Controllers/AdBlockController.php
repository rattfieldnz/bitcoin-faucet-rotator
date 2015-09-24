<?php

namespace App\Http\Controllers;

use App\AdBlock;
use App\User;
use Helpers\Validators\AdBlockValidator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Chromabits\Purifier\Contracts\Purifier;
use HTMLPurifier_Config;

class AdBlockController extends Controller
{
    /**
     * @var Purifier
     */
    protected $purifier;

    /**
     * Construct an instance of MyClass
     *
     * @param Purifier $purifier
     */
    function __construct(Purifier $purifier)   {
        $this->middleware('auth');
        $this->purifier = $purifier;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user())
        {
            $adsUserId = Auth::user()->id;
        }
        else {
            $adsUserId = (int)User::where('is_admin', '=', true)->firstOrFail()->id;
        }

        $adBlock = User::find($adsUserId)->adBlock;

        if(count($adBlock) == 0) {
            return view('ad_block.create');
        }
        else{
            return view('ad_block.edit', compact('adBlock'));
        }

    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //Create the validator to process input for validation.
        $input = $this->purifier->clean(Input::except('_token'));

        $validator = Validator::make($input, AdBlockValidator::validationRules());

        if($validator->fails()){
            return Redirect::to('/admin/ad_block_config')
                ->withErrors($validator)
                ->withInput($input);
        }
        else{

            $adBlock = new AdBlock();
            $adBlock->fill($input);

            $adBlock->save();

            Session::flash('success_message_add', 'The Ad Block has successfully been created and stored!');

            return Redirect::to('/admin/ad_block_config');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdBlock $adBlock
     * @return Response
     */
    public function update(AdBlock $adBlock)
    {
        $adBlock = $adBlock::firstOrFail();
        $input = Input::except('_token');
        $validator = Validator::make($input, AdBlockValidator::validationRules());

        if($validator->fails()){
            return Redirect::to('admin/ad_block_config')
                ->withErrors($validator)
                ->withInput($input);
        }
        else{
            //die(var_dump($input));
            $adBlock->fill($input);

            $adBlock->save();

            Session::flash('success_message_update', 'The Ad Block has successfully been updated!');

            return Redirect::to('admin/ad_block_config');

        }
    }
}
