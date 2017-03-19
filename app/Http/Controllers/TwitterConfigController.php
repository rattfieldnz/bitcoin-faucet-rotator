<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TwitterConfig;
use App\User;
use Helpers\Validators\TwitterConfigValidator;
use Http\Controllers\IController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;

/**
 * Class TwitterConfigController
 *
 * A controller class for storing and updating Twitter
 * OAuth keys - required for Twitter interaction.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Http\Controllers
 */
class TwitterConfigController extends Controller implements IController
{

    /**
     * TwitterConfigController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays the Twitter OAuth keys in an editable form.
     * If there are no credentials, the form is configured
     * for a new set of credentials.
     *
     * @return Response
     */
    public function index()
    {
        $twitterConfig = User::find(Auth::user()->id)->twitterConfig;

        if (count($twitterConfig) == 0) {
            return view('twitter_config.create');
        }
        return view('twitter_config.edit', compact('twitterConfig'));
    }

    /**
     * Stores newly created Twitter OAuth keys in storage.
     *
     * @return Response
     */
    public function store()
    {
        //Create the validator to process input for validation.
        $input = self::cleanInput(Input::except('_token'));
        $validator = Validator::make($input, TwitterConfigValidator::validationRules());

        if ($validator->fails()) {
            return Redirect::to('/admin/twitter_config')
                ->withErrors($validator)
                ->withInput($input);
        }
        $twitterConfig = new TwitterConfig();
        $twitterConfig->fill($input);

        $twitterConfig->save();

        Session::flash(
            'success_message_add',
            'The Twitter configuration has successfully been created and stored!'
        );

        return Redirect::to('/admin/twitter_config');
    }

    /**
     * Update the Twitter OAuth keys in storage.
     *
     * @param TwitterConfig $twitterConfig
     * @return Response
     */
    public function update(TwitterConfig $twitterConfig)
    {
        $twitterConfig = $twitterConfig::firstOrFail();
        $input = self::cleanInput(Input::except('_token'));
        $validator = Validator::make($input, TwitterConfigValidator::validationRules());

        if ($validator->fails()) {
            return Redirect::to('admin/twitter_config')
                ->withErrors($validator)
                ->withInput($input);
        }
        $twitterConfig->fill($input);

        $twitterConfig->save();

        Session::flash('success_message_update', 'The Twitter configuration has successfully been updated!');

        return Redirect::to('admin/twitter_config');
    }

    /**
     * @param array $input
     * @return array
     */
    static function cleanInput(array $input)
    {
        $input['consumer_key'] = Purifier::clean($input['consumer_key'], 'generalFields');
        $input['consumer_key_secret'] = Purifier::clean($input['consumer_key_secret'], 'generalFields');
        $input['access_token'] = Purifier::clean($input['access_token'], 'generalFields');
        $input['access_token_secret'] = Purifier::clean($input['access_token_secret'], 'generalFields');
        $input['user_id'] = Purifier::clean($input['user_id'], 'generalFields');

        return $input;
    }
}
