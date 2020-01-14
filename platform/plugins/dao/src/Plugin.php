<?php

namespace Botble\Dao;

use Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('daos');
        Schema::dropIfExists('dao_registers');
        Schema::dropIfExists('customers');
    }
}
