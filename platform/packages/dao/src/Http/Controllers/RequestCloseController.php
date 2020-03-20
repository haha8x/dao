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

        page_title()->setTitle(trans('packages/dao::request-close.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/dao::request-close.create'));

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
     * @return string
     * @throws \Throwable
     */
    public function info($id)
    {
        $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);

        return view('packages/dao::request.new.info', compact('daoRequestNew'))->render();
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function receive($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'receive';
            $this->daoRequestNewRepository->createOrUpdate($daoRequestNew);

            return $response
                ->setNextUrl(route('request-new.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-new.index'))
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
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'reject';
            $this->daoRequestNewRepository->createOrUpdate($daoRequestNew);

            return $response
                ->setNextUrl(route('request-new.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-new.index'))
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
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'it_process';
            $this->daoRequestNewRepository->createOrUpdate($daoRequestNew);

            return $response
                ->setNextUrl(route('request-new.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-new.index'))
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
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'gdcn_approve';
            $this->daoRequestNewRepository->createOrUpdate($daoRequestNew);

            return $response
                ->setNextUrl(route('request-new.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-new.index'))
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
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'hoiso_approve';
            $this->daoRequestNewRepository->createOrUpdate($daoRequestNew);

            return $response
                ->setNextUrl(route('request-new.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-new.index'))
                ->setMessage($exception->getMessage());
        }
    }

    public function create_dao($id, DaoRequestNewRequest $request, BaseHttpResponse $response)
    {
        try {
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'success';

            $DaoData = [
                'zone_id' => $daoRequestNew->zone_id,
                'branch_id' => $daoRequestNew->branch_id,
                'staff_id' => $daoRequestNew->status,
                'name' => $daoRequestNew->staff_name,
                'position_id' => $daoRequestNew->position_id,
                'cif' => $daoRequestNew->cif,
                'email' => $daoRequestNew->email,
                'cmnd' => $daoRequestNew->cmnd,
                'phone' => $daoRequestNew->phone,
                'status' => 60,
                'created_by' => Auth::id(),
            ];
            $DaoDataRequest = new DaoRequest($DaoData);

            $Dao = $this->daoRepository->createOrUpdate(array_merge($DaoDataRequest->input()));

            $this->daoRequestNewRepository->createOrUpdate($daoRequestNew);
            event(new CreatedContentEvent(DAO_MODULE_SCREEN_NAME, $DaoDataRequest, $Dao));

            return $response
                ->setNextUrl(route('dao.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-new.index'))
                ->setMessage($exception->getMessage());
        }
    }
}
