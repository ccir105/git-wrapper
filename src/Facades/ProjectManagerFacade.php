<?php namespace Shokse\ProjectApi\Facades;

use Illuminate\Support\Facades\Facade;

class ProjectManagerFacade extends Facade{

    public static function getFacadeAccessor(){
        return 'projectManager';
    }
}