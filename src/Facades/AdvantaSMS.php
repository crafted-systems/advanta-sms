<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/13/17
 * Time: 6:39 AM
 */

namespace CraftedSystems\Advanta\Facades;

use Illuminate\Support\Facades\Facade;

class AdvantaSMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'advanta-sms';
    }
}