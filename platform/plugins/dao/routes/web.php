<?php

Route::group(['namespace' => 'Botble\Dao\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'daos', 'as' => 'dao.'], function () {
            Route::resource('', 'DaoController')->parameters(['' => 'dao']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'DaoController@deletes',
                'permission' => 'dao.destroy',
            ]);
        });

        Route::group(['prefix' => 'dao-registers', 'as' => 'dao-register.'], function () {
            Route::resource('', 'DaoRegisterController')->parameters(['' => 'dao-register']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'DaoRegisterController@deletes',
                'permission' => 'dao-register.destroy',
            ]);
        });

        Route::group(['prefix' => 'customers', 'as' => 'customer.'], function () {
            Route::resource('', 'CustomerController')->parameters(['' => 'customer']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'CustomerController@deletes',
                'permission' => 'customer.destroy',
            ]);
        });


    });

});
