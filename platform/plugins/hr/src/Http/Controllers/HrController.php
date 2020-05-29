<?php

namespace Botble\Hr\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Hr\Http\Requests\HrRequest;
use Botble\Hr\Repositories\Interfaces\HrInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Hr\Tables\HrTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Hr\Forms\HrForm;
use Botble\Base\Forms\FormBuilder;

class HrController extends BaseController
{
    /**
     * @var HrInterface
     */
    protected $hrRepository;

    /**
     * HrController constructor.
     * @param HrInterface $hrRepository
     */
    public function __construct(HrInterface $hrRepository)
    {
        $this->hrRepository = $hrRepository;
    }

    /**
     * Display all hrs
     * @param HrTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(HrTable $table)
    {

        page_title()->setTitle(trans('plugins/hr::hr.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/hr::hr.create'));

        return $formBuilder->create(HrForm::class)->renderForm();
    }

    /**
     * Insert new Hr into database
     *
     * @param HrRequest $request
     * @return BaseHttpResponse
     */
    public function store(HrRequest $request, BaseHttpResponse $response)
    {
        $hr = $this->hrRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(HR_MODULE_SCREEN_NAME, $request, $hr));

        return $response
            ->setPreviousUrl(route('hr.index'))
            ->setNextUrl(route('hr.edit', $hr->id))
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
        $hr = $this->hrRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $hr));

        page_title()->setTitle(trans('plugins/hr::hr.edit') . ' "' . $hr->name . '"');

        return $formBuilder->create(HrForm::class, ['model' => $hr])->renderForm();
    }

    /**
     * @param $id
     * @param HrRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, HrRequest $request, BaseHttpResponse $response)
    {
        $hr = $this->hrRepository->findOrFail($id);

        $hr->fill($request->input());

        $this->hrRepository->createOrUpdate($hr);

        event(new UpdatedContentEvent(HR_MODULE_SCREEN_NAME, $request, $hr));

        return $response
            ->setPreviousUrl(route('hr.index'))
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
            $hr = $this->hrRepository->findOrFail($id);

            $this->hrRepository->delete($hr);

            event(new DeletedContentEvent(HR_MODULE_SCREEN_NAME, $request, $hr));

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
            $hr = $this->hrRepository->findOrFail($id);
            $this->hrRepository->delete($hr);
            event(new DeletedContentEvent(HR_MODULE_SCREEN_NAME, $request, $hr));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }

    public function activate($id, BaseHttpResponse $response)
    {
        try {

            $activation = AclManager::getActivationRepository()->create($id);
            if (AclManager::getActivationRepository()->complete($id, $activation->code)) {
                return true;
            }

            return $response
                ->setNextUrl(route('request-close.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('request-close.index'))
                ->setMessage($exception->getMessage());
        }

        if (!$user instanceof User) {
            throw new InvalidArgumentException('No valid user was provided.');
        }

        event('acl.activating', $user);

        $activation = $this->activationRepository->createUser($user);

        event('acl.activated', [$user, $activation]);

        return $this->activationRepository->complete($user, $activation->code);
    }
}
