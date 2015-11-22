<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MainMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class RotatorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $mainMeta = MainMeta::firstOrFail() != null ? MainMeta::firstOrFail() : null;
        return view('rotator.index', compact('mainMeta'));
    }
}
