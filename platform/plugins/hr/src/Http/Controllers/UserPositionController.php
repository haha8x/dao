<?php

namespace Botble\Hr\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Hr\Http\Requests\UserPositionRequest;
use Botble\Hr\Repositories\Interfaces\UserPositionInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Hr\Tables\UserPositionTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Hr\Forms\UserPositionForm;
use Botble\Base\Forms\FormBuilder;

class UserPositionController extends BaseController
{
    /**
     * @var UserPositionInterface
     */
    protected $userPositionRepository;

    /**
     * @param UserPositionInterface $userPositionRepository
     */
    public function __construct(UserPositionInterface $userPositionRepository)
    {
        $this->userPositionRepository = $userPositionRepository;
    }

    /**
     * @param UserPositionTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(UserPositionTable $table)
    {
        page_title()->setTitle(trans('plugins/hr::user-position.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/hr::user-position.create'));

        return $formBuilder->create(UserPositionForm::class)->renderForm();
    }

    /**
     * @param UserPositionRequest $request
     * @return BaseHttpResponse
     */
    public function store(UserPositionRequest $request, BaseHttpResponse $response)
    {
        $userPosition = $this->userPositionRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(USER_POSITION_MODULE_SCREEN_NAME, $request, $userPosition));

        return $response
            ->setPreviousUrl(route('user-position.index'))
            ->setNextUrl(route('user-position.edit', $userPosition->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $userPosition = $this->userPositionRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $userPosition));

        page_title()->setTitle(trans('plugins/hr::user-position.edit') . ' "' . $userPosition->name . '"');

        return $formBuilder->create(UserPositionForm::class, ['model' => $userPosition])->renderForm();
    }

    /**
     * @param $id
     * @param UserPositionRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, UserPositionRequest $request, BaseHttpResponse $response)
    {
        $userPosition = $this->userPositionRepository->findOrFail($id);

        $userPosition->fill($request->input());

        $this->userPositionRepository->createOrUpdate($userPosition);

        event(new UpdatedContentEvent(USER_POSITION_MODULE_SCREEN_NAME, $request, $userPosition));

        return $response
            ->setPreviousUrl(route('user-position.index'))
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
            $userPosition = $this->userPositionRepository->findOrFail($id);

            $this->userPositionRepository->delete($userPosition);

            event(new DeletedContentEvent(USER_POSITION_MODULE_SCREEN_NAME, $request, $userPosition));

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
            $userPosition = $this->userPositionRepository->findOrFail($id);
            $this->userPositionRepository->delete($userPosition);
            event(new DeletedContentEvent(USER_POSITION_MODULE_SCREEN_NAME, $request, $userPosition));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
