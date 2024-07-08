<?php

declare(strict_types = 1);

use JetBrains\PhpStorm\NoReturn;

function getQueryParams(string $path): array
{
    $requestParts = parse_url($path);
    parse_str($requestParts['query'], $queryParams);
    return $queryParams;
}

#[NoReturn] function sendResponse($data, $httpHeaders=array()): void
{
    header_remove('Set-Cookie');
    if (is_array($httpHeaders) && count($httpHeaders)) {
        foreach ($httpHeaders as $httpHeader) {
            header($httpHeader);
        }
    }
    echo $data;
    exit();
}