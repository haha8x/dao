<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Dao\Http\Requests\DaoRequest;
use Botble\Dao\Repositories\Interfaces\DaoInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Dao\Tables\DaoTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\DaoForm;
use Botble\Base\Forms\FormBuilder;

class DaoController extends BaseController
{
    /**
     * @var DaoInterface
     */
    protected $daoRepository;

    /**
     * DaoController constructor.
     * @param DaoInterface $daoRepository
     */
    public function __construct(DaoInterface $daoRepository)
    {
        $this->daoRepository = $daoRepository;
    }

    /**
     * Display all daos
     * @param DaoTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(DaoTable $table)
    {

        page_title()->setTitle(trans('plugins/dao::dao.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/dao::dao.create'));

        return $formBuilder->create(DaoForm::class)->renderForm();
    }

    /**
     * Insert new Dao into database
     *
     * @param DaoRequest $request
     * @return BaseHttpResponse
     */
    public function store(DaoRequest $request, BaseHttpResponse $response)
    {
        $dao = $this->daoRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(DAO_MODULE_SCREEN_NAME, $request, $dao));

        return $response
            ->setPreviousUrl(route('dao.index'))
            ->setNextUrl(route('dao.edit', $dao-request->id))
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
        $dao = $this->daoRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $dao));

        page_title()->setTitle(trans('plugins/dao::dao.edit') . ' "' . $dao-request->name . '"');

        return $formBuilder->create(DaoForm::class, ['model' => $dao])->renderForm();
    }

    /**
     * @param $id
     * @param DaoRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, DaoRequest $request, BaseHttpResponse $response)
    {
        $dao = $this->daoRepository->findOrFail($id);

        $dao-request->fill($request->input());

        $this->daoRepository->createOrUpdate($dao);

        event(new UpdatedContentEvent(DAO_MODULE_SCREEN_NAME, $request, $dao));

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
            $dao = $this->daoRepository->findOrFail($id);

            $this->daoRepository->delete($dao);

            event(new DeletedContentEvent(DAO_MODULE_SCREEN_NAME, $request, $dao));

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
            $dao = $this->daoRepository->findOrFail($id);
            $this->daoRepository->delete($dao);
            event(new DeletedContentEvent(DAO_MODULE_SCREEN_NAME, $request, $dao));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
