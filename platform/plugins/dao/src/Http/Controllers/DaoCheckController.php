<?php

namespace Botble\Dao\Http\Controllers;

use Assets;
use Botble\ACL\Repositories\Interfaces\UserInterface;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Illuminate\Http\Request;
use Botble\Table\TableBuilder;
use Botble\Dao\Tables\DaoCheckTable;

class DaoCheckController extends BaseController
{
    /**
     * @var BaseHttpResponse
     */
    protected $response;

    protected $tableBuilder;

    /**
     * Create a new controller instance.
     *
     * @param BaseHttpResponse $response
     */
    public function __construct(
        BaseHttpResponse $response,
        TableBuilder $tableBuilder
    ) {
        $this->middleware('guest');
        $this->response = $response;
        $this->tableBuilder = $tableBuilder;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formCheck()
    {
        page_title()->setTitle('Kiểm tra thông tin DAO');

        Assets::addScripts(['jquery-validation'])
            // ->addScriptsDirectly('vendor/plugins/dao/js/validate.js')
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

        return view('plugins/dao::check.form');
    }

    public function check(Request $request)
    {
        $staff_id = app(UserInterface::class)->getFirstBy(
            [
                'branch_id' => $request->input('branch_id'),
                'staff_id' => $request->input('staff_id'),
            ]
        );

        $email = app(UserInterface::class)->getFirstBy(
            [
                'branch_id' => $request->input('branch_id'),
                'email' => $request->input('email'),
            ]
        );

        $cmnd = app(UserInterface::class)->getFirstBy(
            [
                'branch_id' => $request->input('branch_id'),
                'cmnd' => $request->input('cmnd'),
            ]
        );

        if (!empty($staff_id)) {
            $id = $staff_id->id;
            return $this->tableBuilder->create(DaoCheckTable::class)
                ->setAjaxUrl(route('dao.list', $id ? $id : 0))
                ->renderTable();
        }

        return view('plugins/dao::check.not-found');
    }

    public function list(DaoCheckTable $table)
    {
        page_title()->setTitle(trans('plugins/dao::dao.name'));

        return $table->renderTable();
    }
}
