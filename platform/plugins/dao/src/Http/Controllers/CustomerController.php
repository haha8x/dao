<?php

namespace Botble\Dao\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Dao\Http\Requests\CustomerRequest;
use Botble\Dao\Repositories\Interfaces\CustomerInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Dao\Tables\CustomerTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dao\Forms\CustomerForm;
use Botble\Base\Forms\FormBuilder;

class CustomerController extends BaseController
{
    /**
     * @var CustomerInterface
     */
    protected $customerRepository;

    /**
     * CustomerController constructor.
     * @param CustomerInterface $customerRepository
     */
    public function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param CustomerTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(CustomerTable $table)
    {

        page_title()->setTitle(trans('plugins/dao::customer.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/dao::customer.create'));

        return $formBuilder->create(CustomerForm::class)->renderForm();
    }

    /**
     * Insert new Customer into database
     *
     * @param CustomerRequest $request
     * @return BaseHttpResponse
     */
    public function store(CustomerRequest $request, BaseHttpResponse $response)
    {
        $customer = $this->customerRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(CUSTOMER_MODULE_SCREEN_NAME, $request, $customer));

        return $response
            ->setPreviousUrl(route('customer.index'))
            ->setNextUrl(route('customer.edit', $customer->id))
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
        $customer = $this->customerRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $customer));

        page_title()->setTitle(trans('plugins/dao::customer.edit') . ' "' . $customer->name . '"');

        return $formBuilder->create(CustomerForm::class, ['model' => $customer])->renderForm();
    }

    /**
     * @param $id
     * @param CustomerRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, CustomerRequest $request, BaseHttpResponse $response)
    {
        $customer = $this->customerRepository->findOrFail($id);

        $customer->fill($request->input());

        $this->customerRepository->createOrUpdate($customer);

        event(new UpdatedContentEvent(CUSTOMER_MODULE_SCREEN_NAME, $request, $customer));

        return $response
            ->setPreviousUrl(route('customer.index'))
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
            $customer = $this->customerRepository->findOrFail($id);

            $this->customerRepository->delete($customer);

            event(new DeletedContentEvent(CUSTOMER_MODULE_SCREEN_NAME, $request, $customer));

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
            $customer = $this->customerRepository->findOrFail($id);
            $this->customerRepository->delete($customer);
            event(new DeletedContentEvent(CUSTOMER_MODULE_SCREEN_NAME, $request, $customer));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
