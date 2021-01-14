<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Dao\Http\Requests\RequestHistoryRequest;
use Botble\Dao\Repositories\Interfaces\RequestHistoryInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Dao\Tables\RequestHistoryTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\RequestHistoryForm;
use Botble\Base\Forms\FormBuilder;

class RequestHistoryController extends BaseController
{
    /**
     * @var RequestHistoryInterface
     */
    protected $requestHistoryRepository;

    /**
     * RequestHistoryController constructor.
     * @param RequestHistoryInterface $requestHistoryRepository
     */
    public function __construct(RequestHistoryInterface $requestHistoryRepository)
    {
        $this->requestHistoryRepository = $requestHistoryRepository;
    }

    /**
     * @param RequestHistoryTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(RequestHistoryTable $table)
    {
        page_title()->setTitle(trans('packages/dao::request-history.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/dao::request-history.create'));

        return $formBuilder->create(RequestHistoryForm::class)->renderForm();
    }

    /**
     * Create new item
     *
     * @param RequestHistoryRequest $request
     * @return BaseHttpResponse
     */
    public function store(RequestHistoryRequest $request, BaseHttpResponse $response)
    {
        $requestHistory = $this->requestHistoryRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(REQUEST_HISTORY_MODULE_SCREEN_NAME, $request, $requestHistory));

        return $response
            ->setPreviousUrl(route('request-history.index'))
            ->setNextUrl(route('request-history.edit', $requestHistory->id))
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
        $requestHistory = $this->requestHistoryRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $requestHistory));

        page_title()->setTitle(trans('packages/dao::request-history.edit') . ' "' . $requestHistory->name . '"');

        return $formBuilder->create(RequestHistoryForm::class, ['model' => $requestHistory])->renderForm();
    }

    /**
     * @param $id
     * @param RequestHistoryRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, RequestHistoryRequest $request, BaseHttpResponse $response)
    {
        $requestHistory = $this->requestHistoryRepository->findOrFail($id);

        $requestHistory->fill($request->input());

        $this->requestHistoryRepository->createOrUpdate($requestHistory);

        event(new UpdatedContentEvent(REQUEST_HISTORY_MODULE_SCREEN_NAME, $request, $requestHistory));

        return $response
            ->setPreviousUrl(route('request-history.index'))
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
            $requestHistory = $this->requestHistoryRepository->findOrFail($id);

            $this->requestHistoryRepository->delete($requestHistory);

            event(new DeletedContentEvent(REQUEST_HISTORY_MODULE_SCREEN_NAME, $request, $requestHistory));

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
            $requestHistory = $this->requestHistoryRepository->findOrFail($id);
            $this->requestHistoryRepository->delete($requestHistory);
            event(new DeletedContentEvent(REQUEST_HISTORY_MODULE_SCREEN_NAME, $request, $requestHistory));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
