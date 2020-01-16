<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Dao\Http\Requests\DaoRequestTransferRequest;
use Botble\Dao\Repositories\Interfaces\DaoRequestTransferInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Dao\Tables\DaoRequestTransferTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\DaoRequestTransferForm;
use Botble\Base\Forms\FormBuilder;

class DaoRequestTransferController extends BaseController
{
    /**
     * @var DaoRequestTransferInterface
     */
    protected $daoRequestTransferRepository;

    /**
     * DaoRequestTransferController constructor.
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

        page_title()->setTitle(trans('plugins/dao::dao-request-transfer.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/dao::dao-request-transfer.create'));

        return $formBuilder->create(DaoRequestTransferForm::class)->renderForm();
    }

    /**
     * Insert new DaoRequestTransfer into database
     *
     * @param DaoRequestTransferRequest $request
     * @return BaseHttpResponse
     */
    public function store(DaoRequestTransferRequest $request, BaseHttpResponse $response)
    {
        $daoRequestTransfer = $this->daoRequestTransferRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(DAO_REQUEST_TRANSFER_MODULE_SCREEN_NAME, $request, $daoRequestTransfer));

        return $response
            ->setPreviousUrl(route('dao-request-transfer.index'))
            ->setNextUrl(route('dao-request-transfer.edit', $daoRequestTransfer->id))
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

        page_title()->setTitle(trans('plugins/dao::dao-request-transfer.edit') . ' "' . $daoRequestTransfer->name . '"');

        return $formBuilder->create(DaoRequestTransferForm::class, ['model' => $daoRequestTransfer])->renderForm();
    }

    /**
     * @param $id
     * @param DaoRequestTransferRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, DaoRequestTransferRequest $request, BaseHttpResponse $response)
    {
        $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);

        $daoRequestTransfer->fill($request->input());

        $this->daoRequestTransferRepository->createOrUpdate($daoRequestTransfer);

        event(new UpdatedContentEvent(DAO_REQUEST_TRANSFER_MODULE_SCREEN_NAME, $request, $daoRequestTransfer));

        return $response
            ->setPreviousUrl(route('dao-request-transfer.index'))
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
}
