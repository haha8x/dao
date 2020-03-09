<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Dao\Http\Requests\DaoRequestNewRequest;
use Botble\Dao\Repositories\Interfaces\DaoRequestNewInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Dao\Tables\DaoRequestNewTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\DaoRequestNewForm;
use Botble\Base\Forms\FormBuilder;

class DaoRequestNewController extends BaseController
{
    /**
     * @var DaoRequestNewInterface
     */
    protected $daoRequestNewRepository;

    /**
     * DaoRequestNewController constructor.
     * @param DaoRequestNewInterface $daoRequestNewRepository
     */
    public function __construct(DaoRequestNewInterface $daoRequestNewRepository)
    {
        $this->daoRequestNewRepository = $daoRequestNewRepository;
    }

    /**
     * @param DaoRequestNewTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(DaoRequestNewTable $table)
    {

        page_title()->setTitle(trans('packages/dao::dao-request-new.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/dao::dao-request-new.create'));

        return $formBuilder->create(DaoRequestNewForm::class)->renderForm();
    }

    /**
     * Insert new DaoRequestNew into database
     *
     * @param DaoRequestNewRequest $request
     * @return BaseHttpResponse
     */
    public function store(DaoRequestNewRequest $request, BaseHttpResponse $response)
    {
        $daoRequestNew = $this->daoRequestNewRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(DAO_REQUEST_NEW_MODULE_SCREEN_NAME, $request, $daoRequestNew));

        return $response
            ->setPreviousUrl(route('dao-request-new.index'))
            ->setNextUrl(route('dao-request-new.edit', $daoRequestNew->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * Show edit form
     *
     * @param $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $daoRequestNew));

        page_title()->setTitle(trans('packages/dao::dao-request-new.edit') . ' "' . $daoRequestNew->name . '"');

        return $formBuilder->create(DaoRequestNewForm::class, ['model' => $daoRequestNew])->renderForm();
    }

    /**
     * @param $id
     * @param DaoRequestNewRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, DaoRequestNewRequest $request, BaseHttpResponse $response)
    {
        $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);

        $daoRequestNew->fill($request->input());

        $this->daoRequestNewRepository->createOrUpdate($daoRequestNew);

        event(new UpdatedContentEvent(DAO_REQUEST_NEW_MODULE_SCREEN_NAME, $request, $daoRequestNew));

        return $response
            ->setPreviousUrl(route('dao-request-new.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);

            $this->daoRequestNewRepository->delete($daoRequestNew);

            event(new DeletedContentEvent(DAO_REQUEST_NEW_MODULE_SCREEN_NAME, $request, $daoRequestNew));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.cannot_delete'));
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $this->daoRequestNewRepository->delete($daoRequestNew);
            event(new DeletedContentEvent(DAO_REQUEST_NEW_MODULE_SCREEN_NAME, $request, $daoRequestNew));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function approve($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'gdcn_approve';
            $this->daoRequestNewRepository->createOrUpdate($daoRequestNew);

            return $response
                ->setNextUrl(route('dao-request-new.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('dao-request-new.index'))
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function removeSuper($id, Request $request, BaseHttpResponse $response)
    {
        if ($request->user()->getKey() == $id) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::system.cannot_revoke_yourself'));
        }

        $user = $this->userRepository->findOrFail($id);

        $user->updatePermission(ACL_ROLE_SUPER_USER, false);
        $user->updatePermission(ACL_ROLE_MANAGE_SUPERS, false);
        $user->super_user = 0;
        $user->manage_supers = 0;
        $this->userRepository->createOrUpdate($user);

        return $response
            ->setNextUrl(route('users.index'))
            ->setMessage(trans('core/base::system.supper_revoked'));
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function info($id)
    {
        $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);

        return view('packages/dao::request-new.info', compact('daoRequestNew'))->render();
    }
}
