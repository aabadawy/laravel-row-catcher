<?php

namespace Aabadawy\RowCatcher\Facade;

use Illuminate\Support\Facades\Facade;
use \Aabadawy\RowCatcher\Contract\RowCatcher as RowCatcherContract;

class RowCatcher extends Facade
{

    protected static function getFacadeAccessor()
    {
        return RowCatcherContract::class;
    }
}