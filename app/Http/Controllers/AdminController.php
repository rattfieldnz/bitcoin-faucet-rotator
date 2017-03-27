<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Helpers\Transformers\UserTransformer;
use Helpers\Validators\AdminValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;

/**
 * Class AdminController
 *
 * A controller class meant for showing admin-specific details
 * for the single admin user of the application.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @todo Build in more functionality!
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * @var UserTransformer
     */
    private $userTransformer;


    /**
     * AdminController constructor.
     * @param UserTransformer $userTransformer
     */
    public function __construct(UserTransformer $userTransformer)
    {
        $this->middleware('auth');
        $this->userTransformer = $userTransformer;
    }

    /**
     * Display details specific to the single admin user.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.index', compact('user'));
    }

    public function edit(){
        $user = Auth::user()
            ->where('is_admin', true)
            ->first();
        return view('admin.edit', compact('user'));

    }

    public function update(){
        $user = Auth::user()
            ->where('is_admin', true)
            ->first();

        $input = Input::all();

        $rules = AdminValidator::validationRulesEdit($user->id);

        //dd(empty(Input::get('password')));

        if (empty(Input::get('password')) || Input::get('password') == "" || Input::get('password') == null) {
            $rules['password'] = [
            ];
            $rules['password_confirmation'] = [
            ];
        }

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        }

        $user->fill(self::cleanInput($input));
        $user->save();


        Session::flash('success_message_edit_admin_details', 'The admin user details has successfully been updated!');

        return Redirect::to(route('admin'));


    }

    static function cleanInput(array $data)
    {
        $data['user_name'] = Purifier::clean($data['user_name'], 'generalFields');
        $data['first_name'] = Purifier::clean($data['first_name'], 'generalFields');
        $data['last_name'] = Purifier::clean($data['last_name'], 'generalFields');
        $data['email'] = Purifier::clean($data['email'], 'generalFields');
        if(isset($data['password']) && isset($data['password_confirmation'])){
            $data['password'] = Purifier::clean(bcrypt($data['password']), 'generalFields');
        }
        $data['bitcoin_address'] = Purifier::clean($data['bitcoin_address'], 'generalFields');
        $data['is_admin'] = Purifier::clean($data['is_admin'], 'generalFields');

        return $data;
    }

    /**
     * Display the specified admin user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return $this->userTransformer->transform($user);
    }
}
