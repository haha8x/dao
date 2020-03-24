<?php

namespace Botble\Catalog\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Catalog\Http\Requests\CatalogZoneRequest;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Catalog\Tables\CatalogZoneTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Catalog\Forms\CatalogZoneForm;
use Botble\Base\Forms\FormBuilder;

class CatalogZoneController extends BaseController
{
    /**
     * @var CatalogZoneInterface
     */
    protected $catalogZoneRepository;

    /**
     * CatalogZoneController constructor.
     * @param CatalogZoneInterface $catalogZoneRepository
     */
    public function __construct(CatalogZoneInterface $catalogZoneRepository)
    {
        $this->catalogZoneRepository = $catalogZoneRepository;
    }

    /**
     * @param CatalogZoneTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(CatalogZoneTable $table)
    {

        page_title()->setTitle(trans('plugins/catalog::catalog-zone.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/catalog::catalog-zone.create'));

        return $formBuilder->create(CatalogZoneForm::class)->renderForm();
    }

    /**
     * Insert new CatalogZone into database
     *
     * @param CatalogZoneRequest $request
     * @return BaseHttpResponse
     */
    public function store(CatalogZoneRequest $request, BaseHttpResponse $response)
    {
        $catalogZone = $this->catalogZoneRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(CATALOG_ZONE_MODULE_SCREEN_NAME, $request, $catalogZone));

        return $response
            ->setPreviousUrl(route('catalog-zone.index'))
            ->setNextUrl(route('catalog-zone.edit', $catalogZone->id))
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
        $catalogZone = $this->catalogZoneRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $catalogZone));

        page_title()->setTitle(trans('plugins/catalog::catalog-zone.edit') . ' "' . $catalogZone->name . '"');

        return $formBuilder->create(CatalogZoneForm::class, ['model' => $catalogZone])->renderForm();
    }

    /**
     * @param $id
     * @param CatalogZoneRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, CatalogZoneRequest $request, BaseHttpResponse $response)
    {
        $catalogZone = $this->catalogZoneRepository->findOrFail($id);

        $catalogZone->fill($request->input());

        $this->catalogZoneRepository->createOrUpdate($catalogZone);

        event(new UpdatedContentEvent(CATALOG_ZONE_MODULE_SCREEN_NAME, $request, $catalogZone));

        return $response
            ->setPreviousUrl(route('catalog-zone.index'))
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
            $catalogZone = $this->catalogZoneRepository->findOrFail($id);

            $this->catalogZoneRepository->delete($catalogZone);

            event(new DeletedContentEvent(CATALOG_ZONE_MODULE_SCREEN_NAME, $request, $catalogZone));

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
            $catalogZone = $this->catalogZoneRepository->findOrFail($id);
            $this->catalogZoneRepository->delete($catalogZone);
            event(new DeletedContentEvent(CATALOG_ZONE_MODULE_SCREEN_NAME, $request, $catalogZone));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
