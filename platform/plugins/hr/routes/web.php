<?php

Route::group(['namespace' => 'Botble\Hr\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'hrs', 'as' => 'hr.'], function () {
            Route::resource('', 'HrController')->parameters(['' => 'hr']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'HrController@deletes',
                'permission' => 'hr.destroy',
            ]);
        });

        Route::group(['prefix' => 'user-positions', 'as' => 'user-position.'], function () {
            Route::resource('', 'UserPositionController')->parameters(['' => 'user-position']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'UserPositionController@deletes',
                'permission' => 'user-position.destroy',
            ]);
        });

        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('activate/{id}', [
                'as'         => 'activate',
                'uses'       => 'HrController@activate',
                'permission' => 'request-new.success',
            ]);
            Route::get('deactivate/{id}', [
                'as'         => 'deactivate',
                'uses'       => 'HrController@deactivate',
                'permission' => 'request-new.success',
            ]);
        });
    });
});
