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
        return 'plugins/catalog::field.zone-branch';
    }
}
