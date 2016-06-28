<?php
/**
 * Created by PhpStorm.
 * User: threeel
 * Date: 6/28/16
 * Time: 2:55 AM
 */

namespace Threeel\Clarifai\Facade;

use Illuminate\Support\Facades\Facade;


class ClarifaiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'clarifai';
    }
}