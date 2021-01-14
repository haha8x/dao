<?php

namespace Botble\Catalog;

use Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('catalog_branches');
        Schema::dropIfExists('catalog_zones');
        Schema::dropIfExists('catalog_positions');
    }
}
