<?php

namespace Aabadawy\RowCatcher;

use \Illuminate\Support\ServiceProvider;

class RowCatcherServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('row-catcher',function (){
            return new RowCatcher();
        });
    }

    public function boot()
    {
        
    }
}