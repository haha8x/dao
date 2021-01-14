<?php

namespace Botble\Catalog\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class CatalogZoneBranchField extends FormField
{

    /**
     * {@inheritDoc}
     */
    protected function getTemplate()
    {
        return 'packages/catalog::field.zone-branch';
    }
}
