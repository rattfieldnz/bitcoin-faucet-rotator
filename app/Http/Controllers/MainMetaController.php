<?php namespace App\Http\Controllers;

use app\Helpers\Validators\MainMetaValidator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Chromabits\Purifier\Contracts\Purifier;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


use App\MainMeta;
use Illuminate\Http\Request;

/**
 * Class MainMetaController
 *
 * A class to handle storing and updating of the
 * site's main meta information.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Http\Controllers
 */
class MainMetaController extends Controller
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
        $input = Input::except('_token', 'page_main_content');
        $mainContent = $this->purifier->clean(Input::get('page_main_content'));
        $input['page_main_content'] = $mainContent;

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

        $input = Input::except('_token');
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
}
