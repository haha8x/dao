<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Dao\Http\Requests\DaoRequestUpdateRequest;
use Botble\Dao\Repositories\Interfaces\DaoRequestUpdateInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Dao\Tables\DaoRequestUpdateTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\DaoRequestUpdateForm;
use Botble\Base\Forms\FormBuilder;

class RequestUpdateController extends BaseController
{
    /**
     * @var DaoRequestUpdateInterface
     */
    protected $daoRequestUpdateRepository;

    /**
     * RequestUpdateController constructor.
     * @param DaoRequestUpdateInterface $daoRequestUpdateRepository
     */
    public function __construct(DaoRequestUpdateInterface $daoRequestUpdateRepository)
    {
        $this->daoRequestUpdateRepository = $daoRequestUpdateRepository;
    }

    /**
     * @param DaoRequestUpdateTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(DaoRequestUpdateTable $table)
    {

        page_title()->setTitle(trans('plugins/dao::request-update.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/dao::request-update.create'));

        return $formBuilder->create(DaoRequestUpdateForm::class)->renderForm();
    }

    /**
     * Insert new DaoRequestUpdate into database
     *
     * @param DaoRequestUpdateRequest $request
     * @return BaseHttpResponse
     */
    public function store(DaoRequestUpdateRequest $request, BaseHttpResponse $response)
    {
        $daoRequestUpdate = $this->daoRequestUpdateRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(DAO_REQUEST_UPDATE_MODULE_SCREEN_NAME, $request, $daoRequestUpdate));

        return $response
            ->setPreviousUrl(route('request-update.index'))
            ->setNextUrl(route('request-update.edit', $daoRequestUpdate->id))
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
        $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $daoRequestUpdate));

        page_title()->setTitle(trans('plugins/dao::request-update.edit') . ' "' . $daoRequestUpdate->name . '"');

        return $formBuilder->create(DaoRequestUpdateForm::class, ['model' => $daoRequestUpdate])->renderForm();
    }

    /**
     * @param $id
     * @param DaoRequestUpdateRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, DaoRequestUpdateRequest $request, BaseHttpResponse $response)
    {
        $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);

        $daoRequestUpdate->fill($request->input());

        $this->daoRequestUpdateRepository->createOrUpdate($daoRequestUpdate);

        event(new UpdatedContentEvent(DAO_REQUEST_UPDATE_MODULE_SCREEN_NAME, $request, $daoRequestUpdate));

        return $response
            ->setPreviousUrl(route('request-update.index'))
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
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);

            $this->daoRequestUpdateRepository->delete($daoRequestUpdate);

            event(new DeletedContentEvent(DAO_REQUEST_UPDATE_MODULE_SCREEN_NAME, $request, $daoRequestUpdate));

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
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $this->daoRequestUpdateRepository->delete($daoRequestUpdate);
            event(new DeletedContentEvent(DAO_REQUEST_UPDATE_MODULE_SCREEN_NAME, $request, $daoRequestUpdate));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function info($id)
    {
        $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);

        return view('plugins/dao::request.transfer.info', compact('daoRequestUpdate'))->render();
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function receive($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'receive';
            $this->daoRequestUpdateRepository->createOrUpdate($daoRequestUpdate);

            return $response
                ->setNextUrl(route('request-update.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-update.index'))
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function reject($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'reject';
            $this->daoRequestUpdateRepository->createOrUpdate($daoRequestUpdate);

            return $response
                ->setNextUrl(route('request-update.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-update.index'))
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function it_process($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'it_process';
            $this->daoRequestUpdateRepository->createOrUpdate($daoRequestUpdate);

            return $response
                ->setNextUrl(route('request-update.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-update.index'))
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function gdcn_approve($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'gdcn_approve';
            $this->daoRequestUpdateRepository->createOrUpdate($daoRequestUpdate);

            return $response
                ->setNextUrl(route('request-update.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-update.index'))
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function hoiso_approve($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'hoiso_approve';
            $this->daoRequestUpdateRepository->createOrUpdate($daoRequestUpdate);

            return $response
                ->setNextUrl(route('request-update.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-update.index'))
                ->setMessage($exception->getMessage());
        }
    }

    public function success($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'success';

            $this->daoRequestUpdateRepository->createOrUpdate($daoRequestUpdate);

            return $response
                ->setNextUrl(route('dao.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-update.index'))
                ->setMessage($exception->getMessage());
        }
    }
}
