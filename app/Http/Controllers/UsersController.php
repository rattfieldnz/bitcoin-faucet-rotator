<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\User;
use Helpers\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

/**
 * Class UsersController
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{

    /**
     * @var UserTransformer
     */
    private $userTransformer;

    /**
     * UsersController constructor.
     * @param UserTransformer $userTransformer
     */
    public function __construct(UserTransformer $userTransformer)
    {
        $this->middleware('auth');
        $this->userTransformer = $userTransformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.index', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return $this->userTransformer->transform($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    /*public function edit($id)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    /*public function update($id)
    {
        //
    }*/
}
