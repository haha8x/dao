<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Dao\Http\Requests\DaoRequestNewRequest;
use Botble\Dao\Repositories\Interfaces\DaoRequestNewInterface;
use Botble\Base\Http\Controllers\BaseController;
use Exception;
use Botble\Dao\Tables\DaoRequestNewTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\RequestNewForm;
use Botble\Base\Forms\FormBuilder;
use Botble\Dao\Http\Requests\DaoRequest;
use Botble\Dao\Repositories\Interfaces\DaoInterface;
use Validator;
use RvMedia;
use Auth;

class RequestNewController extends BaseController
{
    /**
     * @var DaoRequestNewInterface
     */
    protected $daoRequestNewRepository;
    protected $daoRepository;

    /**
     * RequestNewController constructor.
     * @param DaoRequestNewInterface $daoRequestNewRepository
     */
    public function __construct(
        DaoRequestNewInterface $daoRequestNewRepository,
        DaoInterface $daoRepository
    ) {
        $this->daoRequestNewRepository = $daoRequestNewRepository;
        $this->daoRepository = $daoRepository;
    }

    /**
     * @param DaoRequestNewTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(DaoRequestNewTable $table)
    {

        page_title()->setTitle(trans('packages/dao::request-new.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/dao::request-new.create'));

        return $formBuilder->create(RequestNewForm::class)->renderForm();
    }

    /**
     * Insert new DaoRequestNew into database
     *
     * @param DaoRequestNewRequest $request
     * @return BaseHttpResponse
     */
    public function store(DaoRequestNewRequest $request, BaseHttpResponse $response)
    {
        $validator = Validator::make($request->all(), ['decision_file' => 'image|mimes:jpg,jpeg,png']);

        if ($validator->fails()) {
            return redirect()->back();
        }

        if ($request->hasFile('decision_file')) {
            $result = RvMedia::handleUpload($request->file('decision_file'), 0, 'decision');
            if ($result['error'] == false) {
                $file = $result['data'];
                $request->merge(['decision_file' => $file->url]);
            }
        }

        $request
            ->merge(['status' => 'create'])
            ->merge(['staff_name' => mb_strtoupper($request->staff_name)]);

        $daoRequestNew = $this->daoRequestNewRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(DAO_REQUEST_NEW_MODULE_SCREEN_NAME, $request, $daoRequestNew));

        return $response->setMessage('Đăng ký DAO thành công');
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
