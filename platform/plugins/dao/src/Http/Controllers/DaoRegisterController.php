<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Dao\Http\Requests\DaoRegisterRequest;
use Botble\Dao\Repositories\Interfaces\DaoRegisterInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Dao\Tables\DaoRegisterTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\DaoRegisterForm;
use Botble\Base\Forms\FormBuilder;

class DaoRegisterController extends BaseController
{
    /**
     * @var DaoRegisterInterface
     */
    protected $daoRegisterRepository;

    /**
     * DaoRegisterController constructor.
     * @param DaoRegisterInterface $daoRegisterRepository
     */
    public function __construct(DaoRegisterInterface $daoRegisterRepository)
    {
        $this->daoRegisterRepository = $daoRegisterRepository;
    }

    /**
     * @param DaoRegisterTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(DaoRegisterTable $table)
    {

        page_title()->setTitle(trans('plugins/dao::dao-register.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/dao::dao-register.create'));

        return $formBuilder->create(DaoRegisterForm::class)->renderForm();
    }

    /**
     * Insert new DaoRegister into database
     *
     * @param DaoRegisterRequest $request
     * @return BaseHttpResponse
     */
    public function store(DaoRegisterRequest $request, BaseHttpResponse $response)
    {
        $daoRegister = $this->daoRegisterRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(DAO_REGISTER_MODULE_SCREEN_NAME, $request, $daoRegister));

        return $response
            ->setPreviousUrl(route('dao-register.index'))
            ->setNextUrl(route('dao-register.edit', $daoRegister->id))
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
        $daoRegister = $this->daoRegisterRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $daoRegister));

        page_title()->setTitle(trans('plugins/dao::dao-register.edit') . ' "' . $daoRegister->name . '"');

        return $formBuilder->create(DaoRegisterForm::class, ['model' => $daoRegister])->renderForm();
    }

    /**
     * @param $id
     * @param DaoRegisterRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, DaoRegisterRequest $request, BaseHttpResponse $response)
    {
        $daoRegister = $this->daoRegisterRepository->findOrFail($id);

        $daoRegister->fill($request->input());

        $this->daoRegisterRepository->createOrUpdate($daoRegister);

        event(new UpdatedContentEvent(DAO_REGISTER_MODULE_SCREEN_NAME, $request, $daoRegister));

        return $response
            ->setPreviousUrl(route('dao-register.index'))
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
            $daoRegister = $this->daoRegisterRepository->findOrFail($id);

            $this->daoRegisterRepository->delete($daoRegister);

            event(new DeletedContentEvent(DAO_REGISTER_MODULE_SCREEN_NAME, $request, $daoRegister));

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
            $daoRegister = $this->daoRegisterRepository->findOrFail($id);
            $this->daoRegisterRepository->delete($daoRegister);
            event(new DeletedContentEvent(DAO_REGISTER_MODULE_SCREEN_NAME, $request, $daoRegister));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
