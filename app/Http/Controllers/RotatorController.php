<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MainMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RotatorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$main_meta = MainMeta::firstOrFail();
		return view('rotator.index', compact('main_meta'));
	}

}
