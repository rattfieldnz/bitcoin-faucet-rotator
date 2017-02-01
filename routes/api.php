<?php

use Illuminate\Support\Facades\Route;

/*Route::group(['prefix' => 'api/v1'], function () {

    Route::get('faucets', 'ApiController@faucets');
    Route::get('active_faucets', 'ApiController@activeFaucets');
    Route::get('faucets/{id}', 'ApiController@faucet');
    Route::get('payment_processors/{paymentProcessorSlug}/faucets', 'ApiController@paymentProcessorFaucets');
});*/
Route::group([
    'as' => 'api/v1.',
    'prefix' => 'v1'
], function(){
    Route::get('faucets', 'ApiController@faucets');
    Route::get('active_faucets', 'ApiController@activeFaucets');
    Route::get('faucets/{id}', 'ApiController@faucet');
    Route::get('payment_processors/{paymentProcessorSlug}/faucets', 'ApiController@paymentProcessorFaucets');
}
);