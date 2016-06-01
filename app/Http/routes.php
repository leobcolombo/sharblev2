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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin', 'as'=>'admin.', 'middleware'=>'auth.checkrole:admin'],function(){
    Route::group(['prefix'=>'categories', 'as'=>'categories.'],function(){
        Route::get('', ['as'=>'index', 'uses'=>"CategoriesController@index"]);
        Route::get('create', ['as'=>'create', 'uses'=>"CategoriesController@create"]);
        Route::post('store', ['as'=>'store', 'uses'=>"CategoriesController@store"]);
        Route::get('edit/{id}', ['as'=>'edit', 'uses'=>"CategoriesController@edit"]);
        Route::put('update/{id}', ['as'=>'update', 'uses'=>"CategoriesController@update"]);
        Route::get('destroy/{id}', ['as'=>'destroy', 'uses'=>"CategoriesController@destroy"]);
    });
    Route::group(['prefix'=>'products', 'as'=>'products.'],function(){
        Route::get('', ['as'=>'index', 'uses'=>"ProductsController@index"]);
        Route::get('create', ['as'=>'create', 'uses'=>"ProductsController@create"]);
        Route::post('store', ['as'=>'store', 'uses'=>"ProductsController@store"]);
        Route::get('edit/{id}', ['as'=>'edit', 'uses'=>"ProductsController@edit"]);
        Route::put('update/{id}', ['as'=>'update', 'uses'=>"ProductsController@update"]);
        Route::get('destroy/{id}', ['as'=>'destroy', 'uses'=>"ProductsController@destroy"]);
    });
    Route::group(['prefix'=>'clients', 'as'=>'clients.'],function(){
        Route::get('', ['as'=>'index', 'uses'=>"ClientsController@index"]);
        Route::get('create', ['as'=>'create', 'uses'=>"ClientsController@create"]);
        Route::post('store', ['as'=>'store', 'uses'=>"ClientsController@store"]);
        Route::get('edit/{id}', ['as'=>'edit', 'uses'=>"ClientsController@edit"]);
        Route::put('update/{id}', ['as'=>'update', 'uses'=>"ClientsController@update"]);
        Route::get('destroy/{id}', ['as'=>'destroy', 'uses'=>"ClientsController@destroy"]);
    });
    Route::group(['prefix'=>'orders', 'as'=>'orders.'],function(){
        Route::get('', ['as'=>'index', 'uses'=>"OrdersController@index"]);
        Route::get('create', ['as'=>'create', 'uses'=>"OrdersController@create"]);
        Route::post('store', ['as'=>'store', 'uses'=>"OrdersController@store"]);
        Route::get('edit/{id}', ['as'=>'edit', 'uses'=>"OrdersController@edit"]);
        Route::put('update/{id}', ['as'=>'update', 'uses'=>"OrdersController@update"]);
        Route::get('destroy/{id}', ['as'=>'destroy', 'uses'=>"OrdersController@destroy"]);
    });

    Route::group(['prefix'=>'cupoms', 'as'=>'cupoms.'],function(){
        Route::get('', ['as'=>'index', 'uses'=>"CupomsController@index"]);
        Route::get('create', ['as'=>'create', 'uses'=>"CupomsController@create"]);
        Route::post('store', ['as'=>'store', 'uses'=>"CupomsController@store"]);
        Route::get('edit/{id}', ['as'=>'edit', 'uses'=>"CupomsController@edit"]);
        Route::put('update/{id}', ['as'=>'update', 'uses'=>"CupomsController@update"]);
        Route::get('destroy/{id}', ['as'=>'destroy', 'uses'=>"CupomsController@destroy"]);
    });
});

Route::group(['prefix'=>'customer', 'middleware'=>'auth.checkrole:client','as'=>'customer.'], function(){
    Route::group(['prefix'=>'order', 'as'=>'order.'],function(){
        Route::get('', ['as'=>'index', 'uses'=>'CheckoutController@index']);
        Route::get('create', ['as'=>'create', 'uses'=>'CheckoutController@create']);
        Route::post('store', ['as'=>'store', 'uses'=>'CheckoutController@store']);
    });
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});


Route::group(['prefix'=>'api', 'as'=>'api.', 'middleware'=>'oauth'],function(){

    Route::get('authenticated', 'Auth\AuthController@authenticated');

    Route::group(['prefix'=>'client', 'as'=>'client.', 'middleware'=>'oauth.checkrole:client'],function(){
        Route::resource('order','Api\Client\ClientCheckoutController', ['except'=>['create','edit','destroy']]);
    });

    Route::group(['prefix'=>'deliveryman', 'as'=>'deliveryman.', 'middleware'=>'oauth.checkrole:deliveryman'],function(){
        Route::resource('order','Api\Deliveryman\DeliverymanCheckoutController', ['except'=>['create','edit','destroy','store']]);
        Route::patch('order/{id}/update-status', ['uses'=>'Api\Deliveryman\DeliverymanCheckoutController@updateStatus','as'=>'order.update_status']);
    });

});
