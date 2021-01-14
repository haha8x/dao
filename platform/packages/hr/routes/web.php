<?php

Route::group(['namespace' => 'Botble\Hr\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::group(['prefix' => '', 'as' => 'user.'], function () {
            Route::get('register/user', [
                'as'         => 'register',
                'uses'       => 'RegisterUserController@create',
            ]);
            Route::post('register/user', [
                'as'         => 'register',
                'uses'       => 'RegisterUserController@store',
            ]);
        });
    });

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'hrs', 'as' => 'hr.'], function () {
            Route::resource('', 'HrController')->parameters(['' => 'hr']);
            Route::get('new-user', [
                'as'         => 'new-user',
                'uses'       => 'HrController@index_new_user',
            ]);
            Route::get('cbbh', [
                'as'         => 'cbbh',
                'uses'       => 'HrController@index_cbbh',
            ]);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'HrController@deletes',
                'permission' => 'hr.destroy',
            ]);
        });

        // Route::group(['prefix' => 'user-positions', 'as' => 'user-position.'], function () {
        //     Route::resource('', 'UserPositionController')->parameters(['' => 'user-position']);
        //     Route::delete('items/destroy', [
        //         'as'         => 'deletes',
        //         'uses'       => 'UserPositionController@deletes',
        //         'permission' => 'user-position.destroy',
        //     ]);
        // });

        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('activate/{id}', [
                'as'         => 'activate',
                'uses'       => 'HrController@activate',
                'permission' => 'hr.activate',
            ]);
            Route::get('deactivate/{id}', [
                'as'         => 'deactivate',
                'uses'       => 'HrController@deactivate',
                'permission' => 'hr.deactivate',
            ]);
        });
    });
});
