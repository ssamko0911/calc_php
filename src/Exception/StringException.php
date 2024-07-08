<?php

namespace App\Exception;
class StringException extends AbstractException
{
    private const string ERROR_CODE = 'STRING_ERROR_CODE';

    public function __construct(string $errorMessage, string $operand, ?\Throwable $previous = null)
    {
        $message = sprintf('%s: %s', $errorMessage, $operand);
        parent::__construct($message, self::ERROR_CODE, $previous);
    }
}
