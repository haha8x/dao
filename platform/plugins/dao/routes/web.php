<?php

Route::group(['namespace' => 'Botble\Dao\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::group(['prefix' => '', 'as' => 'dao.'], function () {
            Route::get('check', [
                'as'         => 'check',
                'uses'       => 'DaoCheckController@formCheck',
            ]);
            Route::post('check', [
                'as'         => 'check',
                'uses'       => 'DaoCheckController@check',
            ]);

            Route::get('list', [
                'as'         => 'list',
                'uses'       => 'DaoCheckController@list',
            ]);

            Route::get('register/dao', [
                'as'         => 'register',
                'uses'       => 'RequestNewController@create',
            ]);
            Route::post('register/dao', [
                'as'         => 'register',
                'uses'       => 'RequestNewController@store',
            ]);
        });
    });

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

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

            Route::get('tiep_nhan/{id}', [
                'as'         => 'tiep_nhan',
                'uses'       => 'RequestNewController@tiep_nhan',
                'permission' => 'request-new.tiep_nhan',
            ]);

            Route::get('tu_choi/{id}', [
                'as'         => 'tu_choi',
                'uses'       => 'RequestNewController@tu_choi',
                'permission' => 'request-new.tu_choi',
            ]);

            Route::get('it-process/{id}', [
                'as'         => 'it_xuly',
                'uses'       => 'RequestNewController@it_xuly',
                'permission' => 'request-new.it_xuly',
            ]);

            Route::get('gdcn-approve/{id}', [
                'as'         => 'gdcn_duyet',
                'uses'       => 'RequestNewController@gdcn_duyet',
                'permission' => 'request-new.gdcn_duyet',
            ]);

            Route::get('hoiso-approve/{id}', [
                'as'         => 'hoiso_duyet',
                'uses'       => 'RequestNewController@hoiso_duyet',
                'permission' => 'request-new.hoiso_duyet',
            ]);

            Route::get('thanh_cong/{id}', [
                'as'         => 'thanh_cong',
                'uses'       => 'RequestNewController@thanh_cong',
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

            Route::get('tiep_nhan/{id}', [
                'as'         => 'tiep_nhan',
                'uses'       => 'RequestUpdateController@tiep_nhan',
                'permission' => 'request-update.tiep_nhan',
            ]);

            Route::get('tu_choi/{id}', [
                'as'         => 'tu_choi',
                'uses'       => 'RequestUpdateController@tu_choi',
                'permission' => 'request-update.tu_choi',
            ]);

            Route::get('it-process/{id}', [
                'as'         => 'it_xuly',
                'uses'       => 'RequestUpdateController@it_xuly',
                'permission' => 'request-update.it_xuly',
            ]);

            Route::get('gdcn-approve/{id}', [
                'as'         => 'gdcn_duyet',
                'uses'       => 'RequestUpdateController@gdcn_duyet',
                'permission' => 'request-update.gdcn_duyet',
            ]);

            Route::get('hoiso-approve/{id}', [
                'as'         => 'hoiso_duyet',
                'uses'       => 'RequestUpdateController@hoiso_duyet',
                'permission' => 'request-update.hoiso_duyet',
            ]);

            Route::get('thanh_cong/{id}', [
                'as'         => 'thanh_cong',
                'uses'       => 'RequestUpdateController@thanh_cong',
                'permission' => 'request-update.thanh_cong',
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

            Route::get('tiep_nhan/{id}', [
                'as'         => 'tiep_nhan',
                'uses'       => 'RequestTransferController@tiep_nhan',
                'permission' => 'request-transfer.tiep_nhan',
            ]);

            Route::get('tu_choi/{id}', [
                'as'         => 'tu_choi',
                'uses'       => 'RequestTransferController@tu_choi',
                'permission' => 'request-transfer.tu_choi',
            ]);

            Route::get('it-process/{id}', [
                'as'         => 'it_xuly',
                'uses'       => 'RequestTransferController@it_xuly',
                'permission' => 'request-transfer.it_xuly',
            ]);

            Route::get('gdcn-approve/{id}', [
                'as'         => 'gdcn_duyet',
                'uses'       => 'RequestTransferController@gdcn_duyet',
                'permission' => 'request-transfer.gdcn_duyet',
            ]);

            Route::get('hoiso-approve/{id}', [
                'as'         => 'hoiso_duyet',
                'uses'       => 'RequestTransferController@hoiso_duyet',
                'permission' => 'request-transfer.hoiso_duyet',
            ]);

            Route::get('thanh_cong/{id}', [
                'as'         => 'thanh_cong',
                'uses'       => 'RequestTransferController@thanh_cong',
                'permission' => 'request-transfer.thanh_cong',
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

            Route::get('tiep_nhan/{id}', [
                'as'         => 'tiep_nhan',
                'uses'       => 'RequestCloseController@tiep_nhan',
                'permission' => 'request-close.tiep_nhan',
            ]);

            Route::get('tu_choi/{id}', [
                'as'         => 'tu_choi',
                'uses'       => 'RequestCloseController@tu_choi',
                'permission' => 'request-close.tu_choi',
            ]);

            Route::get('it-process/{id}', [
                'as'         => 'it_xuly',
                'uses'       => 'RequestCloseController@it_xuly',
                'permission' => 'request-close.it_xuly',
            ]);

            Route::get('gdcn-approve/{id}', [
                'as'         => 'gdcn_duyet',
                'uses'       => 'RequestCloseController@gdcn_duyet',
                'permission' => 'request-close.gdcn_duyet',
            ]);

            Route::get('hoiso-approve/{id}', [
                'as'         => 'hoiso_duyet',
                'uses'       => 'RequestCloseController@hoiso_duyet',
                'permission' => 'request-close.hoiso_duyet',
            ]);

            Route::get('thanh_cong/{id}', [
                'as'         => 'thanh_cong',
                'uses'       => 'RequestCloseController@thanh_cong',
                'permission' => 'request-close.thanh_cong',
            ]);
        });
    });
});
