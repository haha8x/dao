<?php

Route::group(['namespace' => 'Botble\EnhancedSetting\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'settings/enhanced-setting'], function () {
            Route::get('', [
                'as'   => 'enhanced-setting.settings',
                'uses' => 'EnhancedSettingController@getSettings',
            ]);
            Route::post('', [
                'as'   => 'enhanced-setting.settings',
                'uses' => 'EnhancedSettingController@postSettings',
            ]);
        });
    });
});
