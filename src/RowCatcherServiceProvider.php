<?php

namespace Aabadawy\RowCatcher;

use \Illuminate\Support\ServiceProvider;
use \Aabadawy\RowCatcher\Contract\RowCatcher as RowCatcherContract;


class RowCatcherServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(RowCatcherContract::class,RowCatcher::class);
    }

    public function boot()
    {
        
    }
}