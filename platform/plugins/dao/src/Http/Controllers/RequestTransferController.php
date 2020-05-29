<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Dao\Http\Requests\RequestTransferRequest;
use Botble\Dao\Repositories\Interfaces\DaoRequestTransferInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Dao\Tables\DaoRequestTransferTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\RequestTransferForm;
use Botble\Base\Forms\FormBuilder;
use Auth;

class RequestTransferController extends BaseController
{
    /**
     * @var DaoRequestTransferInterface
     */
    protected $daoRequestTransferRepository;

    /**
     * RequestTransferController constructor.
     * @param DaoRequestTransferInterface $daoRequestTransferRepository
     */
    public function __construct(DaoRequestTransferInterface $daoRequestTransferRepository)
    {
        $this->daoRequestTransferRepository = $daoRequestTransferRepository;
    }

    /**
     * @param DaoRequestTransferTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(DaoRequestTransferTable $table)
    {

        page_title()->setTitle(trans('plugins/dao::request-transfer.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/dao::request-transfer.create'));

        return $formBuilder->create(RequestTransferForm::class)->renderForm();
    }

    /**
     * Insert new RequestTransfer into database
     *
     * @param RequestTransferRequest $request
     * @return BaseHttpResponse
     */
    public function store(RequestTransferRequest $request, BaseHttpResponse $response)
    {
        $daoRequestTransfer = $this->daoRequestTransferRepository->createOrUpdate($request->input());

        $request->merge([
            'status' => 'tao_moi',
            'created_by' => Auth::id(),
        ]);

        event(new CreatedContentEvent(DAO_REQUEST_TRANSFER_MODULE_SCREEN_NAME, $request, $daoRequestTransfer));

        return $response
            ->setPreviousUrl(route('request-transfer.index'))
            ->setNextUrl(route('request-transfer.edit', $daoRequestTransfer->id))
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
        $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $daoRequestTransfer));

        page_title()->setTitle(trans('plugins/dao::request-transfer.edit') . ' "' . $daoRequestTransfer->id . '"');

        return $formBuilder->create(RequestTransferForm::class, ['model' => $daoRequestTransfer])->renderForm();
    }

    /**
     * @param $id
     * @param DaoRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, RequestTransferRequest $request, BaseHttpResponse $response)
    {
        $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);

        $request->merge([
            'updated_by' => Auth::id(),
        ]);

        $daoRequestTransfer->fill($request->input());

        $this->daoRequestTransferRepository->createOrUpdate($daoRequestTransfer);

        event(new UpdatedContentEvent(DAO_REQUEST_TRANSFER_MODULE_SCREEN_NAME, $request, $daoRequestTransfer));

        return $response
            ->setPreviousUrl(route('request-transfer.index'))
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
            $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);

            $this->daoRequestTransferRepository->delete($daoRequestTransfer);

            event(new DeletedContentEvent(DAO_REQUEST_TRANSFER_MODULE_SCREEN_NAME, $request, $daoRequestTransfer));

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
            $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);
            $this->daoRequestTransferRepository->delete($daoRequestTransfer);
            event(new DeletedContentEvent(DAO_REQUEST_TRANSFER_MODULE_SCREEN_NAME, $request, $daoRequestTransfer));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function info($id)
    {
        $item = $this->daoRequestTransferRepository->findOrFail($id);

        return view('plugins/dao::request.transfer.info', compact('item'))->render();
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function receive($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);
            $daoRequestTransfer->status = 'receive';
            $this->daoRequestTransferRepository->createOrUpdate($daoRequestTransfer);

            return $response
                ->setNextUrl(route('request-transfer.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-transfer.index'))
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
            $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);
            $daoRequestTransfer->status = 'reject';
            $this->daoRequestTransferRepository->createOrUpdate($daoRequestTransfer);

            return $response
                ->setNextUrl(route('request-transfer.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-transfer.index'))
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
            $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);
            $daoRequestTransfer->status = 'it_process';
            $this->daoRequestTransferRepository->createOrUpdate($daoRequestTransfer);

            return $response
                ->setNextUrl(route('request-transfer.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-transfer.index'))
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
            $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);
            $daoRequestTransfer->status = 'gdcn_approve';
            $this->daoRequestTransferRepository->createOrUpdate($daoRequestTransfer);

            return $response
                ->setNextUrl(route('request-transfer.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-transfer.index'))
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
            $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);
            $daoRequestTransfer->status = 'hoiso_approve';
            $this->daoRequestTransferRepository->createOrUpdate($daoRequestTransfer);

            return $response
                ->setNextUrl(route('request-transfer.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-transfer.index'))
                ->setMessage($exception->getMessage());
        }
    }

    public function success($id, RequestTransferRequest $request, BaseHttpResponse $response)
    {
        try {
            $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);
            $daoRequestTransfer->status = 'success';

            $this->daoRequestTransferRepository->createOrUpdate($daoRequestTransfer);

            return $response
                ->setNextUrl(route('request-transfer.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-transfer.index'))
                ->setMessage($exception->getMessage());
        }
    }
}
