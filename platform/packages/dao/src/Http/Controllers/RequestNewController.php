<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Dao\Http\Requests\RequestNewRequest;
use Botble\Dao\Repositories\Interfaces\RequestNewInterface;
use Botble\Base\Http\Controllers\BaseController;
use Exception;
use Botble\Dao\Tables\RequestNewTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\RequestNewForm;
use Botble\Base\Forms\FormBuilder;
use Botble\Dao\Http\Requests\DaoRequest;
use Validator;
use RvMedia;
use Illuminate\Http\Request;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Events\BeforeEditContentEvent;
use Auth;

class RequestNewController extends BaseController
{
    /**
     * @var RequestNewInterface
     */
    protected $daoRequestNewRepository;

    /**
     * RequestNewController constructor.
     * @param RequestNewInterface $daoRequestNewRepository
     */
    public function __construct(
        RequestNewInterface $daoRequestNewRepository
    ) {
        $this->daoRequestNewRepository = $daoRequestNewRepository;
    }

    /**
     * @param RequestNewTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(RequestNewTable $table)
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
     * Insert new RequestNew into database
     *
     * @param RequestNewRequest $request
     * @return BaseHttpResponse
     */
    public function store(RequestNewRequest $request, BaseHttpResponse $response)
    {
        $validator = Validator::make($request->all(), ['decision_file' => 'mimes:jpeg,bmp,png,gif,pdf|max:10000']);

        if ($validator->fails()) {
            return $response
                ->setError()
                ->setMessage($validator->messages()->first());
        }

        if ($request->hasFile('decision_file')) {
            $result = RvMedia::handleUpload($request->file('decision_file'), 0, 'decision');
            if ($result['error'] == false) {
                $file = $result['data'];
                $request->merge(['decision_file' => $file->url]);
            }
        }

        $request->merge([
            'status' => 'tao_moi',
            'created_by' => Auth::id(),
        ]);

        $daoRequestNew = $this->daoRequestNewRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(DAO_REQUEST_NEW_MODULE_SCREEN_NAME, $request, $daoRequestNew));

        return $response->setMessage('Đăng ký DAO thành công');
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

        page_title()->setTitle(trans('packages/dao::request-new.edit') . ' "' . $daoRequestNew->name . '"');

        return $formBuilder->create(RequestNewForm::class, ['model' => $daoRequestNew])->renderForm();
    }

    /**
     * @param $id
     * @param DaoRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, RequestNewRequest $request, BaseHttpResponse $response)
    {
        $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);

        $request->merge([
            'updated_by' => Auth::id(),
        ]);

        $daoRequestNew->fill($request->input());

        $this->daoRequestNewRepository->createOrUpdate($daoRequestNew);

        event(new UpdatedContentEvent(DAO_REQUEST_NEW_MODULE_SCREEN_NAME, $request, $daoRequestNew));

        return $response
            ->setPreviousUrl(route('request-new.index'))
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
     * @return string
     * @throws \Throwable
     */
    public function info($id)
    {
        $item = $this->daoRequestNewRepository->findOrFail($id);

        return view('packages/dao::request.new.info', compact('item'))->render();
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function tiep_nhan($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'tiep_nhan';
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
    public function tu_choi($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'tu_choi';
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
    public function it_xuly($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'it_xuly';
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
    public function gdcn_duyet($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'gdcn_duyet';
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
    public function hoiso_duyet($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'hoiso_duyet';
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

    public function thanh_cong($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestNew = $this->daoRequestNewRepository->findOrFail($id);
            $daoRequestNew->status = 'thanh_cong';

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
}
