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

Route::group(['prefix' => 'api/v1'], function () {

    Route::get('faucets', 'ApiController@faucets');
    Route::get('active_faucets', 'ApiController@activeFaucets');
    Route::get('faucets/{id}', 'ApiController@faucet');
    Route::get('payment_processors/{paymentProcessorSlug}/faucets', 'ApiController@paymentProcessorFaucets');
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

    Route::group(['middleware' => 'guest'], function () {
        // Login
        Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
        Route::post('login', [
            'as' => 'auth.login.store',
            'before' => 'throttle:2,60',
            'uses' => 'AuthController@postLogin'
        ]);

        // Register
        //Route::get('register', ['as' => 'auth.register', 'uses' => 'AuthController@getRegister']);
        //Route::post('register', ['as' => 'auth.register.store', 'uses' => 'AuthController@postRegister']);
    });

    Route::group(['middleware' => 'auth'], function () {
        // Logout
        Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout']);
    });

});

Route::get('/', 'RotatorController@index');

Route::patch('faucets/checkFaucetsStatus', [
    'as' => 'checkFaucetsStatus', 'uses' => 'FaucetsController@checkFaucetsStatus'
]);
Route::patch('faucets/{$slug}', [
    'as' => 'faucetLowBalance', 'uses' => 'FaucetsController@faucetLowBalance'
]);
Route::patch('checkFaucetsStatus', 'FaucetsController@checkFaucetsStatus');
Route::get('faucets/progress', 'FaucetsController@progress');
Route::get('/admin/faucets/create', 'FaucetsController@create');
Route::get('/admin/faucets/{slug}/edit', 'FaucetsController@edit');
Route::resource('faucets', 'FaucetsController');

Route::resource('payment_processors', 'PaymentProcessorsController');
Route::get('/payment_processors', ['as' => 'payment_processors', 'uses' => 'PaymentProcessorsController@index']);
Route::get('/admin/payment_processors/create', 'PaymentProcessorsController@create');
Route::get('/admin/payment_processors/{slug}/edit', 'PaymentProcessorsController@edit');
Route::get('payment_processors/{paymentProcessorSlug}/rotator', 'PaymentProcessorsController@faucets');


Route::resource('main_meta', 'MainMetaController');
Route::get('/admin/main_meta', 'MainMetaController@index');

Route::resource('admin/twitter_config', 'TwitterConfigController');
Route::get('/admin/twitter_config', 'TwitterConfigController@index');

Route::resource('admin/ad_block_config', 'AdBlockController');
Route::get('/admin/ad_block_config', 'AdBlockController@index');

Route::get('admin/admin', 'AdminController@index');
Route::get('admin/overview', 'AdminController@overview');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('sitemap', function () {

    // create new sitemap object
    $sitemap = App::make("sitemap");

    // set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
    // by default cache is disabled
    $sitemap->setCache('laravel.sitemap', 15);

    // check if there is cached sitemap and build new only if is not
    if (!$sitemap->isCached()) {
    // add item to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), Carbon::now(), '1.0', 'daily');
        $sitemap->add(URL::to('/faucets'), Carbon::now(), '1.0', 'daily');
        $sitemap->add(URL::to('/payment_processors'), Carbon::now(), '1.0', 'daily');

        // get all faucets from db
        $faucets = DB::table('faucets')->orderBy('name', 'asc')->get();

        // add every post to the sitemap
        foreach ($faucets as $f) {
            $url = URL::to("/faucets/" . $f->slug);
            $sitemap->add($url, $f->updated_at, '1.0', 'daily');
        }

        $payment_processors = DB::table('payment_processors')->orderBy('name', 'asc')->get();

        foreach ($payment_processors as $p) {
            $url = URL::to("/payment_processors/" . $p->slug);
            $sitemap->add($url, $p->updated_at, '1.0', 'daily');

            $rotator = URL::to("/payment_processors/" . $p->slug . '/rotator');
            $sitemap->add($rotator, $p->updated_at, '1.0', 'daily');
        }
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('xml');

});

Route::get('feed', function () {

    // create new feed
    $feed = App::make("feed");

    // cache the feed for 60 minutes (second parameter is optional)
    $feed->setCache(60, 'laravelFeedKey');

    // check if there is cached feed and build new only if is not
    //if (!$feed->isCached()) {
        // creating rss feed with our most recent 20 posts
        $faucets = DB::table('faucets')->orderBy('name', 'asc')->get();

        // set your feed's title, description, link, pubdate and language
        $feed->title = 'FreeBTC.Website Bitcoin Faucet Rotator Feed';
        $feed->description = 'The Atom/RSS feed which shows the latest bitcoin faucets.';
        $feed->link = URL::to('feed');
        $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
        $feed->pubdate = $faucets[0]->created_at;
        $feed->lang = 'en';
        $feed->setShortening(true); // true or false
        $feed->setTextLimit(100); // maximum length of description text

    foreach ($faucets as $faucet) {
        $title = isset($faucet->meta_title) == true ? $faucet->meta_title : $faucet->name;

        // set item's title, author, url, pubdate, description and content
        $feed->add(
            $title,
            'FreeBTC.Website Bitcoin Faucet Rotator',
            URL::to('/faucets/' . $faucet->slug),
            $faucet->created_at,
            str_replace('&', ' and ', $faucet->meta_description),
            $faucet->meta_description
        );
    }

        $payment_processors = DB::table('payment_processors')->orderBy('name', 'asc')->get();

    foreach ($payment_processors as $p) {
        $title = isset($p->meta_title) == true ? $p->meta_title : $p->name;

        // set item's title, author, url, pubdate, description and content
        $feed->add(
            $title,
            $p->name,
            URL::to('/payment_processors/' . $p->slug),
            $p->created_at,
            str_replace('&', ' and ', $p->meta_description),
            $p->meta_description
        );

        $rotator = URL::to("/payment_processors/" . $p->slug . '/rotator');
        $feed->add(
            $title,
            $p->name,
            $rotator,
            $p->created_at,
            $p->name . ' Faucet Rotator',
            'Earn free bitcoins from faucets that use "' . $p->name . '" as a payment processor.'
        );
    }

    $feed->setView('pages.rss');
    return $feed->render('rss');

    //}
});

Route::get('500', function()
{
    abort(500);
});
