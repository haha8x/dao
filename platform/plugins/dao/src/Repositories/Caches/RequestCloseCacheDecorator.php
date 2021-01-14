<?php

namespace Botble\Dao\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Dao\Repositories\Interfaces\RequestCloseInterface;

class RequestCloseCacheDecorator extends CacheAbstractDecorator implements RequestCloseInterface
{ }
