<?php

Route::group(['namespace' => 'Botble\Staff\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'staff', 'as' => 'staff.'], function () {
            Route::resource('', 'StaffController')->parameters(['' => 'staff']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'StaffController@deletes',
                'permission' => 'staff.destroy',
            ]);
        });
    });

});
