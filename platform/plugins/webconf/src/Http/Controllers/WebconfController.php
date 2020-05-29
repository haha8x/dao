<?php

namespace Botble\Webconf\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Webconf\Http\Requests\WebconfRequest;
use Botble\Webconf\Repositories\Interfaces\WebconfInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Webconf\Tables\WebconfTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Webconf\Forms\WebconfForm;
use Botble\Base\Forms\FormBuilder;

class WebconfController extends BaseController
{
    /**
     * @var WebconfInterface
     */
    protected $webconfRepository;

    /**
     * @param WebconfInterface $webconfRepository
     */
    public function __construct(WebconfInterface $webconfRepository)
    {
        $this->webconfRepository = $webconfRepository;
    }

    /**
     * @param WebconfTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(WebconfTable $table)
    {
        page_title()->setTitle(trans('plugins/webconf::webconf.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/webconf::webconf.create'));

        return $formBuilder->create(WebconfForm::class)->renderForm();
    }

    /**
     * @param WebconfRequest $request
     * @return BaseHttpResponse
     */
    public function store(WebconfRequest $request, BaseHttpResponse $response)
    {
        $webconf = $this->webconfRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(WEBCONF_MODULE_SCREEN_NAME, $request, $webconf));

        return $response
            ->setPreviousUrl(route('webconf.index'))
            ->setNextUrl(route('webconf.edit', $webconf->id))
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
        $webconf = $this->webconfRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $webconf));

        page_title()->setTitle(trans('plugins/webconf::webconf.edit') . ' "' . $webconf->name . '"');

        return $formBuilder->create(WebconfForm::class, ['model' => $webconf])->renderForm();
    }

    /**
     * @param $id
     * @param WebconfRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, WebconfRequest $request, BaseHttpResponse $response)
    {
        $webconf = $this->webconfRepository->findOrFail($id);

        $webconf->fill($request->input());

        $this->webconfRepository->createOrUpdate($webconf);

        event(new UpdatedContentEvent(WEBCONF_MODULE_SCREEN_NAME, $request, $webconf));

        return $response
            ->setPreviousUrl(route('webconf.index'))
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
            $webconf = $this->webconfRepository->findOrFail($id);

            $this->webconfRepository->delete($webconf);

            event(new DeletedContentEvent(WEBCONF_MODULE_SCREEN_NAME, $request, $webconf));

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
            $webconf = $this->webconfRepository->findOrFail($id);
            $this->webconfRepository->delete($webconf);
            event(new DeletedContentEvent(WEBCONF_MODULE_SCREEN_NAME, $request, $webconf));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
