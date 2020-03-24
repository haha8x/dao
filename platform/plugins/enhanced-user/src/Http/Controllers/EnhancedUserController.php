<?php

namespace Botble\EnhancedUser\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\EnhancedUser\Http\Requests\EnhancedUserRequest;
use Botble\EnhancedUser\Repositories\Interfaces\EnhancedUserInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\EnhancedUser\Tables\EnhancedUserTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\EnhancedUser\Forms\EnhancedUserForm;
use Botble\Base\Forms\FormBuilder;

class EnhancedUserController extends BaseController
{
    /**
     * @var EnhancedUserInterface
     */
    protected $enhancedUserRepository;

    /**
     * EnhancedUserController constructor.
     * @param EnhancedUserInterface $enhancedUserRepository
     */
    public function __construct(EnhancedUserInterface $enhancedUserRepository)
    {
        $this->enhancedUserRepository = $enhancedUserRepository;
    }

    /**
     * @param EnhancedUserTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(EnhancedUserTable $table)
    {
        page_title()->setTitle(trans('plugins/enhanced-user::enhanced-user.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/enhanced-user::enhanced-user.create'));

        return $formBuilder->create(EnhancedUserForm::class)->renderForm();
    }

    /**
     * Create new item
     *
     * @param EnhancedUserRequest $request
     * @return BaseHttpResponse
     */
    public function store(EnhancedUserRequest $request, BaseHttpResponse $response)
    {
        $enhancedUser = $this->enhancedUserRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(ENHANCED_USER_MODULE_SCREEN_NAME, $request, $enhancedUser));

        return $response
            ->setPreviousUrl(route('enhanced-user.index'))
            ->setNextUrl(route('enhanced-user.edit', $enhancedUser->id))
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
        $enhancedUser = $this->enhancedUserRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $enhancedUser));

        page_title()->setTitle(trans('plugins/enhanced-user::enhanced-user.edit') . ' "' . $enhancedUser->name . '"');

        return $formBuilder->create(EnhancedUserForm::class, ['model' => $enhancedUser])->renderForm();
    }

    /**
     * @param $id
     * @param EnhancedUserRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, EnhancedUserRequest $request, BaseHttpResponse $response)
    {
        $enhancedUser = $this->enhancedUserRepository->findOrFail($id);

        $enhancedUser->fill($request->input());

        $this->enhancedUserRepository->createOrUpdate($enhancedUser);

        event(new UpdatedContentEvent(ENHANCED_USER_MODULE_SCREEN_NAME, $request, $enhancedUser));

        return $response
            ->setPreviousUrl(route('enhanced-user.index'))
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
            $enhancedUser = $this->enhancedUserRepository->findOrFail($id);

            $this->enhancedUserRepository->delete($enhancedUser);

            event(new DeletedContentEvent(ENHANCED_USER_MODULE_SCREEN_NAME, $request, $enhancedUser));

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
            $enhancedUser = $this->enhancedUserRepository->findOrFail($id);
            $this->enhancedUserRepository->delete($enhancedUser);
            event(new DeletedContentEvent(ENHANCED_USER_MODULE_SCREEN_NAME, $request, $enhancedUser));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
