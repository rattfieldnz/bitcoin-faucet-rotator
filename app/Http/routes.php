<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::group(['prefix' => 'api/v1'], function()
{
    Route::get('faucets', 'ApiController@faucets');
    Route::get('active_faucets', 'ApiController@activeFaucets');
    Route::get('faucets/{id}', 'ApiController@faucet');
});

Route::get('/', 'RotatorController@index');
Route::patch('faucets/checkFaucetsStatus', [
    'as' => 'checkFaucetsStatus', 'uses' => 'FaucetsController@checkFaucetsStatus'
]);
Route::patch('faucets/{$slug}', [
    'as' => 'faucetLowBalance', 'uses' => 'FaucetsController@faucetLowBalance'
]);
Route::patch('checkFaucetsStatus', 'FaucetsController@checkFaucetsStatus');
Route::get('faucets/progress', 'FaucetsController@progress' );
Route::resource('faucets', 'FaucetsController');
Route::resource('main_meta', 'MainMetaController');
Route::get('admin/admin', 'AdminController@index');
Route::get('admin/overview', 'AdminController@overview');
Route::resource('payment_processors', 'PaymentProcessorsController');

Route::get('payment_processors', 'PaymentProcessorsController@index');

Route::get('home', 'HomeController@index');

Route::get('sitemap', function(){

    // create new sitemap object
    $sitemap = App::make("sitemap");

    // set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
    // by default cache is disabled
    $sitemap->setCache('laravel.sitemap', 15);

    // check if there is cached sitemap and build new only if is not
    if (!$sitemap->isCached())
    {
        // add item to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), Carbon::now(), '1.0', 'daily');
        $sitemap->add(URL::to('/faucets'), Carbon::now(), '1.0', 'daily');
        $sitemap->add(URL::to('/payment_processors'), Carbon::now(), '1.0', 'daily');

        // get all faucets from db
        $faucets = DB::table('faucets')->orderBy('name', 'asc')->get();

        // add every post to the sitemap
        foreach ($faucets as $f)
        {
            $url = URL::to("/faucets/" . $f->slug);
            $sitemap->add($url, $f->updated_at, '1.0', 'daily');
        }

        $payment_processors = DB::table('payment_processors')->orderBy('name', 'asc')->get();

        foreach ($payment_processors as $p)
        {
            $url = URL::to("/payment_processors/" . $p->slug);
            $sitemap->add($url, $p->updated_at, '1.0', 'daily');
        }
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('xml');

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
