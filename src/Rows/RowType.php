<?php

namespace Aabadawy\RowCatcher\Rows;

enum RowType: string
{
    case Failure = 'failure';

    case Success = 'success';
}