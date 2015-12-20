<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MainMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

/**
 * Class RotatorController
 *
 * A controller class for the main page.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Http\Controllers
 */
class RotatorController extends Controller
{

    /**
     * Display the main page.
     *
     * @return Response
     */
    public function index()
    {
        $mainMeta = MainMeta::firstOrFail() != null ? MainMeta::firstOrFail() : null;
        return view('rotator.index', compact('mainMeta'));
    }
}
