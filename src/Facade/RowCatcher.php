<?php

namespace Aabadawy\RowCatcher\Facade;

use Illuminate\Support\Facades\Facade;

class RowCatcher extends Facade
{

    protected static function getFacadeAccessor()
    {
        return "row-catcher";
    }
}