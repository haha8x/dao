<?php

namespace Botble\Catalog\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Catalog\Http\Requests\CatalogPositionRequest;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Catalog\Tables\CatalogPositionTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Catalog\Forms\CatalogPositionForm;
use Botble\Base\Forms\FormBuilder;

class CatalogPositionController extends BaseController
{
    /**
     * @var CatalogPositionInterface
     */
    protected $catalogPositionRepository;

    /**
     * CatalogPositionController constructor.
     * @param CatalogPositionInterface $catalogPositionRepository
     */
    public function __construct(CatalogPositionInterface $catalogPositionRepository)
    {
        $this->catalogPositionRepository = $catalogPositionRepository;
    }

    /**
     * @param CatalogPositionTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(CatalogPositionTable $table)
    {

        page_title()->setTitle(trans('plugins/catalog::catalog-position.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/catalog::catalog-position.create'));

        return $formBuilder->create(CatalogPositionForm::class)->renderForm();
    }

    /**
     * Insert new CatalogPosition into database
     *
     * @param CatalogPositionRequest $request
     * @return BaseHttpResponse
     */
    public function store(CatalogPositionRequest $request, BaseHttpResponse $response)
    {
        $catalogPosition = $this->catalogPositionRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(CATALOG_POSITION_MODULE_SCREEN_NAME, $request, $catalogPosition));

        return $response
            ->setPreviousUrl(route('catalog-position.index'))
            ->setNextUrl(route('catalog-position.edit', $catalogPosition->id))
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
        $catalogPosition = $this->catalogPositionRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $catalogPosition));

        page_title()->setTitle(trans('plugins/catalog::catalog-position.edit') . ' "' . $catalogPosition->name . '"');

        return $formBuilder->create(CatalogPositionForm::class, ['model' => $catalogPosition])->renderForm();
    }

    /**
     * @param $id
     * @param CatalogPositionRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, CatalogPositionRequest $request, BaseHttpResponse $response)
    {
        $catalogPosition = $this->catalogPositionRepository->findOrFail($id);

        $catalogPosition->fill($request->input());

        $this->catalogPositionRepository->createOrUpdate($catalogPosition);

        event(new UpdatedContentEvent(CATALOG_POSITION_MODULE_SCREEN_NAME, $request, $catalogPosition));

        return $response
            ->setPreviousUrl(route('catalog-position.index'))
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
            $catalogPosition = $this->catalogPositionRepository->findOrFail($id);

            $this->catalogPositionRepository->delete($catalogPosition);

            event(new DeletedContentEvent(CATALOG_POSITION_MODULE_SCREEN_NAME, $request, $catalogPosition));

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
            $catalogPosition = $this->catalogPositionRepository->findOrFail($id);
            $this->catalogPositionRepository->delete($catalogPosition);
            event(new DeletedContentEvent(CATALOG_POSITION_MODULE_SCREEN_NAME, $request, $catalogPosition));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
