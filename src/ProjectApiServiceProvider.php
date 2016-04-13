<?php

namespace Shokse\ProjectApi;

use Illuminate\Support\ServiceProvider;
use Shokse\ProjectApi\Logger\Database;
use Shokse\ProjectApi\Logger\FileSystem;


class ProjectApiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('projectManager',function(){
            return new ProjectManager();
        });

        $this->app->bind('taskManager',function(){
            return new TaskManager();
        });

        $this->app->bind('database-logger',function(){
           return new Database();
        });

        $this->app->bind('filesystem-logger',function(){
            return new FileSystem();
        });

        $this->app->bind('Shokse\ProjectApi\Logger\LoggerInterface',function()
        {
            $driver = config('project.log-driver');

            if(!empty($driver))
            {
                return app()->make($driver . '-logger');
            }
            return app()->make('filesystem-logger');
        });

        $this->app->bind('Shokse\ProjectApi\Git\GitInterface','Shokse\ProjectApi\Git\CustomGit');
    }
}