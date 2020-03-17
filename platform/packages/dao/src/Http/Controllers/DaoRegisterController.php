<?php

namespace Botble\Dao\Http\Controllers;

use Assets;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Illuminate\Http\Request;

class DaoRegisterController extends BaseController
{
    /**
     * @var BaseHttpResponse
     */
    protected $response;

    /**
     * Create a new controller instance.
     *
     * @param BaseHttpResponse $response
     */
    public function __construct(BaseHttpResponse $response)
    {
        $this->middleware('guest');
        $this->response = $response;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegisterDaoForm()
    {
        page_title()->setTitle('Đăng ký DAO');

        Assets::addScripts(['jquery-validation'])
            ->addScriptsDirectly('vendor/core/js/login.js')
            ->removeStyles([
                'select2',
                'fancybox',
                'spectrum',
                'simple-line-icons',
                'custom-scrollbar',
                'datepicker',
            ])
            ->removeScripts([
                'select2',
                'fancybox',
                'cookie',
            ]);

        return view('packages/dao::register.dao');
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param Request $request
     * @param  string $response
     * @return BaseHttpResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $this->response->setMessage(trans($response));
    }
}
