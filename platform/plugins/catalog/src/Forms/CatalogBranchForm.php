<?php

namespace Botble\Catalog\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Botble\Catalog\Http\Requests\CatalogBranchRequest;
use Botble\Catalog\Models\CatalogBranch;

class CatalogBranchForm extends FormAbstract
{
    /**
     * @var CatalogZoneInterface
     */
    protected $catalogZoneRepository;

    /**
     * StateForm constructor.
     * @param CountryInterface $countryRepository
     * @param StateInterface $stateRepository
     */
    public function __construct(CatalogZoneInterface $catalogZoneRepository)
    {
        parent::__construct();

        $this->catalogZoneRepository = $catalogZoneRepository;
    }

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $catalogZones = $this->catalogZoneRepository->pluck('catalog_zones.name', 'catalog_zones.id');

        $this
            ->setupModel(new CatalogBranch)
            ->setValidatorClass(CatalogBranchRequest::class)
            ->withCustomFields()
            ->add('zone_id', 'customSelect', [
                'label'      => __('Vùng'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-search-full',
                ],
                'choices'    => [0 => __('Chọn Vùng')] + $catalogZones,
            ])
            ->add('code', 'text', [
                'label'      => __('Mã chi nhánh'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Mã chi nhánh'),
                    'data-counter' => 120,
                ],
            ])
            ->add('name', 'text', [
                'label'      => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ]);
    }
}
