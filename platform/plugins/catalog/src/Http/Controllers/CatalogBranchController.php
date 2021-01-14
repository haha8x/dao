<?php

namespace Botble\Catalog\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Catalog\Http\Requests\CatalogBranchRequest;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Catalog\Tables\CatalogBranchTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Catalog\Forms\CatalogBranchForm;
use Botble\Base\Forms\FormBuilder;
use Botble\Catalog\Http\Resources\BranchResource;
use Auth;

class CatalogBranchController extends BaseController
{
    /**
     * @var CatalogBranchInterface
     */
    protected $catalogBranchRepository;

    /**
     * CatalogBranchController constructor.
     * @param CatalogBranchInterface $catalogBranchRepository
     */
    public function __construct(CatalogBranchInterface $catalogBranchRepository)
    {
        $this->catalogBranchRepository = $catalogBranchRepository;
    }

    /**
     * @param CatalogBranchTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(CatalogBranchTable $table)
    {

        page_title()->setTitle(trans('plugins/catalog::catalog-branch.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/catalog::catalog-branch.create'));

        return $formBuilder->create(CatalogBranchForm::class)->renderForm();
    }

    /**
     * Insert new CatalogBranch into database
     *
     * @param CatalogBranchRequest $request
     * @return BaseHttpResponse
     */
    public function store(CatalogBranchRequest $request, BaseHttpResponse $response)
    {
        $catalogBranch = $this->catalogBranchRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(CATALOG_BRANCH_MODULE_SCREEN_NAME, $request, $catalogBranch));

        return $response
            ->setPreviousUrl(route('catalog-branch.index'))
            ->setNextUrl(route('catalog-branch.edit', $catalogBranch->id))
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
        $catalogBranch = $this->catalogBranchRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $catalogBranch));

        page_title()->setTitle(trans('plugins/catalog::catalog-branch.edit') . ' "' . $catalogBranch->name . '"');

        return $formBuilder->create(CatalogBranchForm::class, ['model' => $catalogBranch])->renderForm();
    }

    /**
     * @param $id
     * @param CatalogBranchRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, CatalogBranchRequest $request, BaseHttpResponse $response)
    {
        $catalogBranch = $this->catalogBranchRepository->findOrFail($id);

        $catalogBranch->fill($request->input());

        $this->catalogBranchRepository->createOrUpdate($catalogBranch);

        event(new UpdatedContentEvent(CATALOG_BRANCH_MODULE_SCREEN_NAME, $request, $catalogBranch));

        return $response
            ->setPreviousUrl(route('catalog-branch.index'))
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
            $catalogBranch = $this->catalogBranchRepository->findOrFail($id);

            $this->catalogBranchRepository->delete($catalogBranch);

            event(new DeletedContentEvent(CATALOG_BRANCH_MODULE_SCREEN_NAME, $request, $catalogBranch));

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
            $catalogBranch = $this->catalogBranchRepository->findOrFail($id);
            $this->catalogBranchRepository->delete($catalogBranch);
            event(new DeletedContentEvent(CATALOG_BRANCH_MODULE_SCREEN_NAME, $request, $catalogBranch));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }

    public function getChangeZone(Request $request, BaseHttpResponse $response)
    {
        if (!Auth::user()->isSuperUser()) {
            $branch = $this->catalogBranchRepository
                ->getModel()
                ->where(['zone_id' => $request->input('zone_id')])
                ->where('id', Auth::user()->getBranch()->first() ? Auth::user()->getBranch()->first()->id : null)
                ->select(['id', 'code', 'name'])
                ->get();
        } else {
            $branch = $this->catalogBranchRepository
                ->getModel()
                ->where(['zone_id' => $request->input('zone_id')])
                ->select(['id', 'code', 'name'])
                ->get();
        }

        return $response
            ->setData(BranchResource::collection($branch))
            ->toApiResponse();
    }
}
