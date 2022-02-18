<?php

namespace Aabadawy\RowCatcher\Rows;

class SuccessRow implements Rowable
{

    public function __construct(protected mixed $row)
    {
    }

    public function type(): RowType
    {
        return RowType::Success;
    }
}