<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
