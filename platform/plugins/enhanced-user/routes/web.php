<?php

Route::group(['namespace' => 'Botble\EnhancedUser\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'enhanced-users', 'as' => 'enhanced-user.'], function () {
            Route::resource('', 'EnhancedUserController')->parameters(['' => 'enhanced-user']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'EnhancedUserController@deletes',
                'permission' => 'enhanced-user.destroy',
            ]);
        });
    });

});
