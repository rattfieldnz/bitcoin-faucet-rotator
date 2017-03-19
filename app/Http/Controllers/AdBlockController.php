<?php namespace App\Http\Controllers;

use App\AdBlock;
use App\User;
use Helpers\Validators\AdBlockValidator;
use Http\Controllers\IController;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;

/**
 * Class AdBlockController
 *
 * A controller class used to handle creation and updating
 * of a site-wide ad block.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Http\Controllers
 */
class AdBlockController extends Controller implements IController
{
    /**
     * @var Purifier
     */
    protected $purifier;

    /**
     * @property int adsUserId
     */
    private $adsUserId;

    /**
     * Construct an instance of AdBlockController
     *
     * @param Purifier $purifier
     */
    public function __construct(Purifier $purifier)
    {
        $this->middleware('auth');
        $this->purifier = $purifier;
    }
    /**
     * Display details of the currently-stored ad block.
     * Shows an empty creation form for an ad block if
     * there is none.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            $this->adsUserId = Auth::user()->id;
        }
        $this->adsUserId = (int)User::where('is_admin', '=', true)->firstOrFail()->id;

        $adBlock = User::find($this->adsUserId)->adBlock;

        if (count($adBlock) == 0) {
            return view('ad_block.create');
        }
        return view('ad_block.edit', compact('adBlock'));
    }

    /**
     * Store a newly created ad bloxk in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //Create the validator to process input for validation.
        $input = self::cleanInput(Input::except('_token'));

        $validator = Validator::make($input, AdBlockValidator::validationRules());

        if ($validator->fails()) {
            return Redirect::to('/admin/ad_block_config')
                ->withErrors($validator)
                ->withInput($input);
        }

        $adBlock = new AdBlock();
        $adBlock->fill($input);

        $adBlock->save();

        Session::flash('success_message_add', 'The Ad Block has successfully been created and stored!');

        return Redirect::to('/admin/ad_block_config');
    }

    /**
     * Update the specified ad block in storage.
     *
     * @param AdBlock $adBlock
     * @return Response
     */
    public function update(AdBlock $adBlock)
    {
        $adBlock = $adBlock::firstOrFail();
        $input = self::cleanInput(Input::except('_token'));
        $validator = Validator::make($input, AdBlockValidator::validationRules());

        if ($validator->fails()) {
            return Redirect::to('admin/ad_block_config')
                ->withErrors($validator)
                ->withInput($input);
        }

        $adBlock->fill($input);

        $adBlock->save();

        Session::flash('success_message_update', 'The Ad Block has successfully been updated!');

        return Redirect::to('admin/ad_block_config');
    }

    /**
     * @param array $input
     * @return mixed
     */
    static function cleanInput(array $input)
    {
        $input['ad_content'] = Purifier::clean($input['ad_content']);
        $input['user_id'] = Purifier::clean($input['user_id'], 'generalFields');

        return $input;
    }
}
