<?php

namespace Botble\EnhancedSetting\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\EnhancedSetting\Http\Requests\UpdateSettingsRequest;
use Botble\Setting\Supports\SettingStore;

class EnhancedSettingController extends BaseController
{
    /**
     * @param SettingStore $settingStore
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function getSettings(SettingStore $settingStore)
    {
        page_title()->setTitle(__('Cài Đặt Hệ Thống'));

        return view('plugins/enhanced-setting::settings');
    }

    /**
     * @param UpdateSettingsRequest $request
     * @param BaseHttpResponse $response
     * @param SettingStore $settingStore
     * @return BaseHttpResponse
     *
     */
    public function postSettings(
        UpdateSettingsRequest $request,
        BaseHttpResponse $response,
        SettingStore $settingStore
    )
    {
        foreach ($request->input('settings', []) as $key => $value) {
            $settingStore->set($key, $value);
        }

        $settingStore->save();

        return $response
            ->setNextUrl(route('enhanced-setting.settings'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }
}
