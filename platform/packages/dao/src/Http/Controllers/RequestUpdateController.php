<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Dao\Http\Requests\RequestUpdateRequest;
use Botble\Dao\Repositories\Interfaces\RequestUpdateInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Dao\Tables\RequestUpdateTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\RequestUpdateForm;
use Botble\Base\Forms\FormBuilder;
use Auth;

class RequestUpdateController extends BaseController
{
    /**
     * @var RequestUpdateInterface
     */
    protected $daoRequestUpdateRepository;

    /**
     * RequestUpdateController constructor.
     * @param RequestUpdateInterface $daoRequestUpdateRepository
     */
    public function __construct(RequestUpdateInterface $daoRequestUpdateRepository)
    {
        $this->daoRequestUpdateRepository = $daoRequestUpdateRepository;
    }

    /**
     * @param RequestUpdateTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(RequestUpdateTable $table)
    {

        page_title()->setTitle(trans('packages/dao::request-update.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/dao::request-update.create'));

        return $formBuilder->create(RequestUpdateForm::class)->renderForm();
    }

    /**
     * Insert new RequestUpdate into database
     *
     * @param RequestUpdateRequest $request
     * @return BaseHttpResponse
     */
    public function store(RequestUpdateRequest $request, BaseHttpResponse $response)
    {
        $request->merge([
            'status' => 'tao_moi',
            'created_by' => Auth::id(),
        ]);
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

        page_title()->setTitle(trans('packages/dao::request-update.edit') . ' "' . $daoRequestUpdate->name . '"');

        return $formBuilder->create(RequestUpdateForm::class, ['model' => $daoRequestUpdate])->renderForm();
    }

    /**
     * @param $id
     * @param RequestUpdateRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, RequestUpdateRequest $request, BaseHttpResponse $response)
    {
        $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);

        $request->merge([
            'updated_by' => Auth::id(),
        ]);

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
        $item = $this->daoRequestUpdateRepository->findOrFail($id);

        return view('packages/dao::request.update.info', compact('item'))->render();
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function tiep_nhan($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'tiep_nhan';
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
    public function tu_choi($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'tu_choi';
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
    public function it_xuly($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'it_xuly';
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
    public function gdcn_duyet($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'gdcn_duyet';
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
    public function hoiso_duyet($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'hoiso_duyet';
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

    public function thanh_cong($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestUpdate = $this->daoRequestUpdateRepository->findOrFail($id);
            $daoRequestUpdate->status = 'thanh_cong';

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
}
