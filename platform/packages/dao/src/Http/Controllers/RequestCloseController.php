<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Dao\Http\Requests\RequestCloseRequest;
use Botble\Dao\Repositories\Interfaces\RequestCloseInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Dao\Tables\RequestCloseTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\RequestCloseForm;
use Botble\Base\Forms\FormBuilder;
use Auth;

class RequestCloseController extends BaseController
{
    /**
     * @var RequestCloseInterface
     */
    protected $daoRequestCloseRepository;

    /**
     * RequestCloseController constructor.
     * @param RequestCloseInterface $daoRequestCloseRepository
     */
    public function __construct(RequestCloseInterface $daoRequestCloseRepository)
    {
        $this->daoRequestCloseRepository = $daoRequestCloseRepository;
    }

    /**
     * @param RequestCloseTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(RequestCloseTable $table)
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

        return $formBuilder->create(RequestCloseForm::class)->renderForm();
    }

    /**
     * Insert new RequestClose into database
     *
     * @param RequestCloseRequest $request
     * @return BaseHttpResponse
     */
    public function store(RequestCloseRequest $request, BaseHttpResponse $response)
    {
        $request->merge([
            'status' => 'tao_moi',
            'created_by' => Auth::id(),
        ]);

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

        page_title()->setTitle(trans('packages/dao::request-close.edit') . ' "' . $daoRequestClose->name . '"');

        return $formBuilder->create(RequestCloseForm::class, ['model' => $daoRequestClose])->renderForm();
    }

    /**
     * @param $id
     * @param DaoRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, RequestCloseRequest $request, BaseHttpResponse $response)
    {
        $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);

        $request->merge([
            'updated_by' => Auth::id(),
        ]);

        $daoRequestClose->fill($request->input());

        $this->daoRequestCloseRepository->createOrUpdate($daoRequestClose);

        event(new UpdatedContentEvent(DAO_REQUEST_CLOSE_MODULE_SCREEN_NAME, $request, $daoRequestClose));

        return $response
            ->setPreviousUrl(route('request-close.index'))
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
        $item = $this->daoRequestCloseRepository->findOrFail($id);

        return view('packages/dao::request.close.info', compact('item'))->render();
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function tiep_nhan($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'tiep_nhan';
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
    public function tu_choi($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'tu_choi';
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
    public function it_xuly($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'it_xuly';
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
    public function gdcn_duyet($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'gdcn_duyet';
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
    public function hoiso_duyet($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'hoiso_duyet';
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

    public function thanh_cong($id, BaseHttpResponse $response)
    {
        try {
            $daoRequestClose = $this->daoRequestCloseRepository->findOrFail($id);
            $daoRequestClose->status = 'thanh_cong';

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
}
