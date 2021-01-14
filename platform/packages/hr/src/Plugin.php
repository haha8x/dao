<?php

namespace Botble\Hr;

use Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('hrs');
        Schema::dropIfExists('user_positions');
    }
}
