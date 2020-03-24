<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Dao\Http\Requests\DaoRequestCloseRequest;
use Botble\Dao\Repositories\Interfaces\DaoRequestCloseInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Dao\Tables\DaoRequestCloseTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\DaoRequestCloseForm;
use Botble\Base\Forms\FormBuilder;

class RequestCloseController extends BaseController
{
    /**
     * @var DaoRequestCloseInterface
     */
    protected $daoRequestCloseRepository;

    /**
     * RequestCloseController constructor.
     * @param DaoRequestCloseInterface $daoRequestCloseRepository
     */
    public function __construct(DaoRequestCloseInterface $daoRequestCloseRepository)
    {
        $this->daoRequestCloseRepository = $daoRequestCloseRepository;
    }

    /**
     * @param DaoRequestCloseTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(DaoRequestCloseTable $table)
    {

        page_title()->setTitle(trans('plugins/dao::request-close.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/dao::request-close.create'));

        return $formBuilder->create(DaoRequestCloseForm::class)->renderForm();
    }

    /**
     * Insert new DaoRequestClose into database
     *
     * @param DaoRequestCloseRequest $request
     * @return BaseHttpResponse
     */
    public function store(DaoRequestCloseRequest $request, BaseHttpResponse $response)
    {
        $daoRequestClose = $this->daoRequestCloseRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(DAO_REQUEST_CLOSE_MODULE_SCREEN_NAME, $request, $daoRequestClose));

        return $response
            ->setPreviousUrl(route('request-close.index'))
            ->setNextUrl(route('request-close.edit', $daoRequestClose->id))
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
        $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $daoRequestClose));

        page_title()->setTitle(trans('plugins/dao::dao.edit') . ' "' . $daoRequestClose->name . '"');

        return $formBuilder->create(DaoRequestCloseForm::class, ['model' => $daoRequestClose])->renderForm();
    }

    /**
     * @param $id
     * @param DaoRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, DaoRequest $request, BaseHttpResponse $response)
    {
        $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);

        $daoRequestClose->fill($request->input());

        $this->daoRequestCloseRepository->createOrUpdate($daoRequestClose);

        event(new UpdatedContentEvent(DAO_REQUEST_CLOSE_MODULE_SCREEN_NAME, $request, $daoRequestClose));

        return $response
            ->setPreviousUrl(route('dao.index'))
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
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);

            $this->daoRequestCloseRepository->delete($daoRequestClose);

            event(new DeletedContentEvent(DAO_REQUEST_CLOSE_MODULE_SCREEN_NAME, $request, $daoRequestClose));

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
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $this->daoRequestCloseRepository->delete($daoRequestClose);
            event(new DeletedContentEvent(DAO_REQUEST_CLOSE_MODULE_SCREEN_NAME, $request, $daoRequestClose));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
    
    /**
     * @return string
     * @throws \Throwable
     */
    public function info($id)
    {
        $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);

        return view('plugins/dao::request.close.info', compact('daoRequestClose'))->render();
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function receive($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'receive';
            $this->daoRequestCloseRepository->createOrUpdate($daoRequestClose);

            return $response
                ->setNextUrl(route('request-close.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-close.index'))
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
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'reject';
            $this->daoRequestCloseRepository->createOrUpdate($daoRequestClose);

            return $response
                ->setNextUrl(route('request-close.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-close.index'))
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
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'it_process';
            $this->daoRequestCloseRepository->createOrUpdate($daoRequestClose);

            return $response
                ->setNextUrl(route('request-close.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-close.index'))
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
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'gdcn_approve';
            $this->daoRequestCloseRepository->createOrUpdate($daoRequestClose);

            return $response
                ->setNextUrl(route('request-close.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-close.index'))
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
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'hoiso_approve';
            $this->daoRequestCloseRepository->createOrUpdate($daoRequestClose);

            return $response
                ->setNextUrl(route('request-close.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-close.index'))
                ->setMessage($exception->getMessage());
        }
    }

    public function success($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'success';

            $this->daoRequestCloseRepository->createOrUpdate($daoRequestClose);

            return $response
                ->setNextUrl(route('dao.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-close.index'))
                ->setMessage($exception->getMessage());
        }
    }
}
