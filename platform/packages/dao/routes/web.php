<?php

Route::group(['namespace' => 'Botble\Dao\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['middleware' => 'guest'], function () {

        Route::group(['prefix' => 'daos', 'as' => 'dao.'], function () {
            Route::get('check', [
                'as'         => 'check',
                'uses'       => 'DaoCheckController@formCheck',
            ]);
            Route::post('check', [
                'as'         => 'check',
                'uses'       => 'DaoCheckController@check',
            ]);

            Route::get('register', [
                'as'         => 'register',
                'uses'       => 'DaoRegisterController@showRegisterDaoForm',
            ]);
            Route::post('register', [
                'as'         => 'register',
                'uses'       => 'DaoRegisterController@RegisterDao',
            ]);

            Route::get('list', [
                'as'         => 'list',
                'uses'       => 'DaoCheckController@list',
            ]);
        });

        Route::group(['prefix' => 'users', 'as' => 'user.'], function () {
            Route::get('register', [
                'as'         => 'register',
                'uses'       => 'UserRegisterController@showRegisterUserForm',
            ]);
            Route::post('register', [
                'as'         => 'register',
                'uses'       => 'UserRegisterController@RegisterUser',
            ]);
        });
    });

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'daos', 'as' => 'dao.'], function () {
            Route::resource('', 'DaoController')->parameters(['' => 'dao']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'DaoController@deletes',
                'permission' => 'dao.destroy',
            ]);

            Route::get('info/{id}', [
                'as'         => 'info',
                'uses'       => 'DaoController@info',
                'permission' => 'dao.info',
            ]);
        });

        Route::group(['prefix' => 'dao/news', 'as' => 'dao-request-new.'], function () {
            Route::resource('', 'DaoRequestNewController')->parameters(['' => 'dao-request-new']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'DaoRequestNewController@deletes',
                'permission' => 'dao-request-new.destroy',
            ]);

            Route::get('info/{id}', [
                'as'         => 'info',
                'uses'       => 'DaoRequestNewController@info',
                'permission' => 'dao-request-new.info',
            ]);

            Route::get('receive/{id}', [
                'as'         => 'receive',
                'uses'       => 'DaoRequestNewController@receive',
                'permission' => 'dao-request-new.receive',
            ]);

            Route::get('reject/{id}', [
                'as'         => 'reject',
                'uses'       => 'DaoRequestNewController@reject',
                'permission' => 'dao-request-new.reject',
            ]);

            Route::get('it_process/{id}', [
                'as'         => 'it_process',
                'uses'       => 'DaoRequestNewController@it_process',
                'permission' => 'dao-request-new.it_process',
            ]);

            Route::get('approve/{id}', [
                'as'         => 'approve',
                'uses'       => 'DaoRequestNewController@approve',
                'permission' => 'dao-request-new.approve',
            ]);

            Route::get('success/{id}', [
                'as'         => 'success',
                'uses'       => 'DaoRequestNewController@success',
                'permission' => 'dao-request-new.success',
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
