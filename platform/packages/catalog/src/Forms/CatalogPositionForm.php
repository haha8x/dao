<?php

namespace Botble\Catalog\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Catalog\Http\Requests\CatalogPositionRequest;
use Botble\Catalog\Models\CatalogPosition;

class CatalogPositionForm extends FormAbstract
{

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $this
            ->setupModel(new CatalogPosition)
            ->setValidatorClass(CatalogPositionRequest::class)
            ->withCustomFields()
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
