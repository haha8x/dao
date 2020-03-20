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

        page_title()->setTitle(trans('packages/dao::request-transfer.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/dao::request-transfer.create'));

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
            ->setPreviousUrl(route('request-transfer.index'))
            ->setNextUrl(route('request-transfer.edit', $daoRequestTransfer->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function info($id)
    {
        $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);

        return view('packages/dao::request.transfer.info', compact('daoRequestTransfer'))->render();
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

    public function transfer_dao($id, DaoRequestTransferRequest $request, BaseHttpResponse $response)
    {
        try {
            $daoRequestTransfer = $this->daoRequestTransferRepository->findOrFail($id);
            $daoRequestTransfer->status = 'success';

            $DaoData = [
                'zone_id' => $daoRequestTransfer->zone_id,
                'branch_id' => $daoRequestTransfer->branch_id,
                'staff_id' => $daoRequestTransfer->status,
                'name' => $daoRequestTransfer->staff_name,
                'position_id' => $daoRequestTransfer->position_id,
                'cif' => $daoRequestTransfer->cif,
                'email' => $daoRequestTransfer->email,
                'cmnd' => $daoRequestTransfer->cmnd,
                'phone' => $daoRequestTransfer->phone,
                'status' => 60,
                'created_by' => Auth::id(),
            ];
            $DaoDataRequest = new DaoRequest($DaoData);

            $Dao = $this->daoRepository->createOrUpdate(array_merge($DaoDataRequest->input()));

            $this->daoRequestTransferRepository->createOrUpdate($daoRequestTransfer);
            event(new CreatedContentEvent(DAO_MODULE_SCREEN_NAME, $DaoDataRequest, $Dao));

            return $response
                ->setNextUrl(route('dao.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-transfer.index'))
                ->setMessage($exception->getMessage());
        }
    }
}
