<?php

Route::group(['namespace' => 'Botble\Dao\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['middleware' => 'guest'], function () {

        Route::group(['prefix' => '', 'as' => 'dao.'], function () {
            Route::get('check', [
                'as'         => 'check',
                'uses'       => 'CheckController@formCheck',
            ]);
            Route::post('check', [
                'as'         => 'check',
                'uses'       => 'CheckController@check',
            ]);

            Route::get('register/dao', [
                'as'         => 'register',
                'uses'       => 'RequestNewController@create',
            ]);
            Route::post('register/dao', [
                'as'         => 'register',
                'uses'       => 'RequestNewController@store',
            ]);

            Route::get('list', [
                'as'         => 'list',
                'uses'       => 'CheckController@list',
            ]);
        });

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

        Route::group(['prefix' => 'staff', 'as' => 'staff.'], function () {
            Route::resource('', 'RegisterUserController')->parameters(['' => 'staff']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'RegisterUserController@deletes',
                'permission' => 'staff.destroy',
            ]);
        });

        Route::group(['prefix' => 'daos', 'as' => 'dao.'], function () {
            Route::resource('', 'DaoController')
                ->parameters(['' => 'dao'])
                ->except(['edit', 'update']);

            Route::get('info/{id}', [
                'as'         => 'info',
                'uses'       => 'DaoController@info',
                'permission' => 'dao.index',
            ]);
        });

        Route::group(['prefix' => 'request-histories', 'as' => 'request-history.'], function () {
            Route::resource('', 'RequestHistoryController')->parameters(['' => 'request-history']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'RequestHistoryController@deletes',
                'permission' => 'request-history.destroy',
            ]);
        });

        Route::group(['prefix' => 'dao/news', 'as' => 'request-new.'], function () {
            Route::resource('', 'RequestNewController')
                ->parameters(['' => 'request-new'])
                ->except(['create', 'store']);
            Route::get('info/{id}', [
                'as'         => 'info',
                'uses'       => 'RequestNewController@info',
                'permission' => 'request-new.index',
            ]);

            Route::get('receive/{id}', [
                'as'         => 'receive',
                'uses'       => 'RequestNewController@receive',
                'permission' => 'request-new.receive',
            ]);

            Route::get('reject/{id}', [
                'as'         => 'reject',
                'uses'       => 'RequestNewController@reject',
                'permission' => 'request-new.reject',
            ]);

            Route::get('it-process/{id}', [
                'as'         => 'it_process',
                'uses'       => 'RequestNewController@it_process',
                'permission' => 'request-new.it_process',
            ]);

            Route::get('gdcn-approve/{id}', [
                'as'         => 'gdcn_approve',
                'uses'       => 'RequestNewController@gdcn_approve',
                'permission' => 'request-new.gdcn_approve',
            ]);

            Route::get('hoiso-approve/{id}', [
                'as'         => 'hoiso_approve',
                'uses'       => 'RequestNewController@hoiso_approve',
                'permission' => 'request-new.hoiso_approve',
            ]);

            Route::get('success/{id}', [
                'as'         => 'success',
                'uses'       => 'RequestNewController@success',
                'permission' => 'request-new.success',
            ]);
        });

        Route::group(['prefix' => 'dao/updates', 'as' => 'request-update.'], function () {
            Route::resource('', 'RequestUpdateController')
                ->parameters(['' => 'request-update']);
            Route::get('info/{id}', [
                'as'         => 'info',
                'uses'       => 'RequestUpdateController@info',
                'permission' => 'request-update.index',
            ]);

            Route::get('receive/{id}', [
                'as'         => 'receive',
                'uses'       => 'RequestUpdateController@receive',
                'permission' => 'request-update.receive',
            ]);

            Route::get('reject/{id}', [
                'as'         => 'reject',
                'uses'       => 'RequestUpdateController@reject',
                'permission' => 'request-update.reject',
            ]);

            Route::get('it-process/{id}', [
                'as'         => 'it_process',
                'uses'       => 'RequestUpdateController@it_process',
                'permission' => 'request-update.it_process',
            ]);

            Route::get('gdcn-approve/{id}', [
                'as'         => 'gdcn_approve',
                'uses'       => 'RequestUpdateController@gdcn_approve',
                'permission' => 'request-update.gdcn_approve',
            ]);

            Route::get('hoiso-approve/{id}', [
                'as'         => 'hoiso_approve',
                'uses'       => 'RequestUpdateController@hoiso_approve',
                'permission' => 'request-update.hoiso_approve',
            ]);

            Route::get('success/{id}', [
                'as'         => 'success',
                'uses'       => 'RequestUpdateController@success',
                'permission' => 'request-update.success',
            ]);
        });

        Route::group(['prefix' => 'dao/transfers', 'as' => 'request-transfer.'], function () {
            Route::resource('', 'RequestTransferController')
                ->parameters(['' => 'request-transfer']);
            Route::get('info/{id}', [
                'as'         => 'info',
                'uses'       => 'RequestTransferController@info',
                'permission' => 'request-transfer.index',
            ]);

            Route::get('receive/{id}', [
                'as'         => 'receive',
                'uses'       => 'RequestTransferController@receive',
                'permission' => 'request-transfer.receive',
            ]);

            Route::get('reject/{id}', [
                'as'         => 'reject',
                'uses'       => 'RequestTransferController@reject',
                'permission' => 'request-transfer.reject',
            ]);

            Route::get('it-process/{id}', [
                'as'         => 'it_process',
                'uses'       => 'RequestTransferController@it_process',
                'permission' => 'request-transfer.it_process',
            ]);

            Route::get('gdcn-approve/{id}', [
                'as'         => 'gdcn_approve',
                'uses'       => 'RequestTransferController@gdcn_approve',
                'permission' => 'request-transfer.gdcn_approve',
            ]);

            Route::get('hoiso-approve/{id}', [
                'as'         => 'hoiso_approve',
                'uses'       => 'RequestTransferController@hoiso_approve',
                'permission' => 'request-transfer.hoiso_approve',
            ]);

            Route::get('success/{id}', [
                'as'         => 'success',
                'uses'       => 'RequestTransferController@success',
                'permission' => 'request-transfer.success',
            ]);
        });

        Route::group(['prefix' => 'dao/closes', 'as' => 'request-close.'], function () {
            Route::resource('', 'RequestCloseController')
            ->parameters(['' => 'request-close']);
            Route::get('info/{id}', [
                'as'         => 'info',
                'uses'       => 'RequestCloseController@info',
                'permission' => 'request-close.index',
            ]);

            Route::get('receive/{id}', [
                'as'         => 'receive',
                'uses'       => 'RequestCloseController@receive',
                'permission' => 'request-close.receive',
            ]);

            Route::get('reject/{id}', [
                'as'         => 'reject',
                'uses'       => 'RequestCloseController@reject',
                'permission' => 'request-close.reject',
            ]);

            Route::get('it-process/{id}', [
                'as'         => 'it_process',
                'uses'       => 'RequestCloseController@it_process',
                'permission' => 'request-close.it_process',
            ]);

            Route::get('gdcn-approve/{id}', [
                'as'         => 'gdcn_approve',
                'uses'       => 'RequestCloseController@gdcn_approve',
                'permission' => 'request-close.gdcn_approve',
            ]);

            Route::get('hoiso-approve/{id}', [
                'as'         => 'hoiso_approve',
                'uses'       => 'RequestCloseController@hoiso_approve',
                'permission' => 'request-close.hoiso_approve',
            ]);

            Route::get('success/{id}', [
                'as'         => 'success',
                'uses'       => 'RequestCloseController@success',
                'permission' => 'request-close.success',
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
