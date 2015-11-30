<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Helpers\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

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
