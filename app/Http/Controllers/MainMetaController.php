<?php namespace App\Http\Controllers;

use app\Helpers\Validators\MainMetaValidator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Http\Controllers\IController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


use App\MainMeta;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

/**
 * Class MainMetaController
 *
 * A class to handle storing and updating of the
 * site's main meta information.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Http\Controllers
 */
class MainMetaController extends Controller implements IController
{
    /**
     * @var Purifier
     */
    protected $purifier;

    /**
     * MainMetaController constructor.
     * @param Purifier $purifier
     */
    public function __construct(Purifier $purifier)
    {
        $this->middleware('auth');
        $this->purifier = $purifier;
    }
    /**
     * Display the site meta information in an editable form.
     * The form will be pre-populated if there is one already
     * in the system.
     *
     * @return Response
     */
    public function index()
    {
        $mainMeta = MainMeta::all();

        if (count($mainMeta) == 0) {
            return view('main_meta.create');
        }
        $mainMeta = MainMeta::first();
        return view('main_meta.edit', compact('mainMeta'));
    }

    /**
     * Store a newly created main meta in storage.
     *
     * @return Response
     */
    public function store()
    {
        //Create the validator to process input for validation.
        $input = self::cleanInput(Input::except('_token'));

        $validator = Validator::make($input, MainMetaValidator::validationRules());

        if ($validator->fails()) {
            return Redirect::to('/admin/main_meta')
                ->withErrors($validator)
                ->withInput($input);
        }
        $mainMeta = new MainMeta();
        $mainMeta->fill($input);

        $mainMeta->save();

        Session::flash('success_message_add', 'The main meta has successfully been created and stored!');

        return Redirect::to('/admin/main_meta/');
    }

    /**
     * Update the specified main meta in storage.
     *
     * @param MainMeta $mainMeta
     * @return Response
     * @internal param int $id
     */
    public function update(MainMeta $mainMeta)
    {
        $mainMeta = $mainMeta::firstOrFail();

        $input = self::cleanInput(Input::except('_token'));

        $validator = Validator::make($input, MainMetaValidator::validationRules());

        if ($validator->fails()) {
            return Redirect::to('/admin/main_meta')
                ->withErrors($validator)
                ->withInput($input);
        }
        $mainMeta->fill($input);

        $mainMeta->save();

        Session::flash('success_message_update', 'The main meta has successfully been updated!');

        return Redirect::to('/admin/main_meta/');
    }

    /**
     * @param array $input
     * @return array
     */
    static function cleanInput(array $input){

        $input['title'] = Purifier::clean($input['title'], 'generalFields');
        $input['description'] = Purifier::clean($input['description'], 'generalFields');
        $input['keywords'] = Purifier::clean($input['keywords'], 'generalFields');
        $input['google_analytics_id'] = Purifier::clean($input['google_analytics_id'], 'generalFields');
        $input['yandex_verification'] = Purifier::clean($input['yandex_verification'], 'generalFields');
        $input['bing_verification'] = Purifier::clean($input['bing_verification'], 'generalFields');
        $input['addthisid'] = Purifier::clean($input['addthisid'], 'generalFields');
        $input['twitter_username'] = Purifier::clean($input['twitter_username'], 'generalFields');
        $input['feedburner_feed_url'] = Purifier::clean($input['feedburner_feed_url'], 'generalFields');
        $input['disqus_shortname'] = Purifier::clean($input['disqus_shortname'], 'generalFields');
        $input['prevent_adblock_blocking'] = Purifier::clean($input['prevent_adblock_blocking'], 'generalFields');
        $input['page_main_title'] = Purifier::clean($input['page_main_title'], 'generalFields');
        $input['page_main_content'] = Purifier::clean($input['page_main_content']);

        return $input;
    }
}
