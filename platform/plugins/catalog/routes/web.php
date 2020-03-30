<?php

Route::group(['namespace' => 'Botble\Catalog\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::post('/get-branch', [
            'as' => 'get-branch',
            'uses' => 'CatalogBranchController@getChangeZone',
        ]);
    });

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'catalog-positions', 'as' => 'catalog-position.'], function () {
            Route::resource('', 'CatalogPositionController')->parameters(['' => 'catalog-position']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'CatalogPositionController@deletes',
                'permission' => 'catalog-position.destroy',
            ]);
        });

        Route::group(['prefix' => 'catalog-zones', 'as' => 'catalog-zone.'], function () {
            Route::resource('', 'CatalogZoneController')->parameters(['' => 'catalog-zone']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'CatalogZoneController@deletes',
                'permission' => 'catalog-zone.destroy',
            ]);
        });

        Route::group(['prefix' => 'catalog-branches', 'as' => 'catalog-branch.'], function () {
            Route::resource('', 'CatalogBranchController')->parameters(['' => 'catalog-branch']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'CatalogBranchController@deletes',
                'permission' => 'catalog-branch.destroy',
            ]);
        });
    });
});
