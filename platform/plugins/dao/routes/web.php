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

        Route::group(['prefix' => 'dao/news', 'as' => 'dao-request-new.'], function () {
            Route::resource('', 'DaoRequestNewController')->parameters(['' => 'dao-request-new']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'DaoRequestNewController@deletes',
                'permission' => 'dao-request-new.destroy',
            ]);
        });

        Route::group(['prefix' => 'dao/updates', 'as' => 'dao-request-update.'], function () {
            Route::resource('', 'DaoRequestUpdateController')->parameters(['' => 'dao-request-update']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'DaoRequestUpdateController@deletes',
                'permission' => 'dao-request-update.destroy',
            ]);
        });

        Route::group(['prefix' => 'dao/transfers', 'as' => 'dao-request-transfer.'], function () {
            Route::resource('', 'DaoRequestTransferController')->parameters(['' => 'dao-request-transfer']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'DaoRequestTransferController@deletes',
                'permission' => 'dao-request-transfer.destroy',
            ]);
        });

        Route::group(['prefix' => 'dao/closes', 'as' => 'dao-request-close.'], function () {
            Route::resource('', 'DaoRequestCloseController')->parameters(['' => 'dao-request-close']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'DaoRequestCloseController@deletes',
                'permission' => 'dao-request-close.destroy',
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
