<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 1:36 PM
 */

namespace Shokse\ProjectApi\Facades;

use Illuminate\Support\Facades\Facade;

class TaskManagerFacade extends Facade{

    public static function getFacadeAccessor(){
        return 'taskManager';
    }
}