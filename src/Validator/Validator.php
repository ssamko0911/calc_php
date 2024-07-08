<?php

namespace App\Validator;

class Validator
{
    public function operandIsFloat($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT);
    }
}