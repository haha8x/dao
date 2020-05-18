<?php

namespace Botble\Captcha\Facades;

use Mews\Captcha\Facades\Captcha;
use Illuminate\Support\Facades\Facade;

class SimpleCaptchaFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     * 
     */
    protected static function getFacadeAccessor()
    {
        return Captcha::class;
    }
}
