<?php

Route::namespace('Home')->prefix('/')->group(function(){
    Route::get('/', 'HomeController@show');
});

Auth::routes();

Route::namespace('Dashboard')->prefix('/dashboard')->middleware('auth')->group(function(){
    Route::get('/', 'DashboardController@show');
});

Route::namespace('Account')->prefix('/account')->middleware('auth')->group(function(){
    Route::namespace('User')->prefix('/user')->group(function(){
        Route::get('/', 'UserController@edit');
        Route::patch('/', 'UserController@update');
    });
    Route::namespace('AddressGroups')->prefix('/address-group')->group(function(){
        Route::get('/', 'AddressGroupController@index');
        Route::get('/create', 'AddressGroupController@create');
        Route::post('/', 'AddressGroupController@store');
        Route::prefix('/{addressGroupKey}')->group(function(){
            Route::get('/', 'AddressGroupController@show');
            Route::get('/edit', 'AddressGroupController@edit');
            Route::patch('/', 'AddressGroupController@update');
            Route::delete('/', 'AddressGroupController@destroy');
        });
    });
});

Route::namespace('Manage')->prefix('/manage')->middleware(['auth','admin'])->group(function(){
    Route::namespace('Accounts')->prefix('/account')->group(function(){
        Route::namespace('Generate')->prefix('/generate')->group(function(){
            Route::get('/','GenerateController@index');
            Route::post('/','GenerateController@store');
        });
    });
});