<?php

namespace Botble\Staff\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Staff\Http\Requests\StaffRequest;
use Botble\Staff\Repositories\Interfaces\StaffInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Staff\Tables\StaffTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Staff\Forms\StaffForm;
use Botble\Base\Forms\FormBuilder;

class StaffController extends BaseController
{
    /**
     * @var StaffInterface
     */
    protected $staffRepository;

    /**
     * StaffController constructor.
     * @param StaffInterface $staffRepository
     */
    public function __construct(StaffInterface $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }

    /**
     * Display all staff
     * @param StaffTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(StaffTable $table)
    {

        page_title()->setTitle(trans('plugins/staff::staff.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/staff::staff.create'));

        return $formBuilder->create(StaffForm::class)->renderForm();
    }

    /**
     * Insert new Staff into database
     *
     * @param StaffRequest $request
     * @return BaseHttpResponse
     */
    public function store(StaffRequest $request, BaseHttpResponse $response)
    {
        $staff = $this->staffRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(STAFF_MODULE_SCREEN_NAME, $request, $staff));

        return $response
            ->setPreviousUrl(route('staff.index'))
            ->setNextUrl(route('staff.edit', $staff->id))
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
        $staff = $this->staffRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $staff));

        page_title()->setTitle(trans('plugins/staff::staff.edit') . ' "' . $staff->name . '"');

        return $formBuilder->create(StaffForm::class, ['model' => $staff])->renderForm();
    }

    /**
     * @param $id
     * @param StaffRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, StaffRequest $request, BaseHttpResponse $response)
    {
        $staff = $this->staffRepository->findOrFail($id);

        $staff->fill($request->input());

        $this->staffRepository->createOrUpdate($staff);

        event(new UpdatedContentEvent(STAFF_MODULE_SCREEN_NAME, $request, $staff));

        return $response
            ->setPreviousUrl(route('staff.index'))
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
            $staff = $this->staffRepository->findOrFail($id);

            $this->staffRepository->delete($staff);

            event(new DeletedContentEvent(STAFF_MODULE_SCREEN_NAME, $request, $staff));

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
            $staff = $this->staffRepository->findOrFail($id);
            $this->staffRepository->delete($staff);
            event(new DeletedContentEvent(STAFF_MODULE_SCREEN_NAME, $request, $staff));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
