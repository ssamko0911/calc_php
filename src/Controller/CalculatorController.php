<?php

namespace App\Controller;

use Error;

class CalculatorController
{
    private function calculateAdd(float $digitOne, float $digitTwo): float
    {
        return bcadd($digitOne, $digitTwo, 2);
    }

    private function calculateSub(float $digitOne, float $digitTwo): float
    {
        return bcsub($digitOne, $digitTwo, 2);
    }

    private function calculateMul(float $digitOne, float $digitTwo): float
    {
        return bcmul($digitOne, $digitTwo, 2);
    }

    private function calculateDiv(float $digitOne, float $digitTwo): float
    {
        return bcdiv($digitOne, $digitTwo, 2);
    }

    public function resultAction($mathSign, $digitOne, $digitTwo): void
    {
        $errors = '';
        $errorDescription = '';
        $errorHeader = '';
        $responseData = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'GET') {
            try {
                $actionName = 'calculate' . ucfirst($mathSign);
                $result = $this->$actionName($digitOne, $digitTwo);
                $responseData = json_encode([
                    'result' => $result,
                ]);
            } catch (Error $e) {
                $errorDescription = $e->getMessage() . 'Something is not right';
                $errorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $errorDescription = 'Method not supported';
            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$errors) {
            sendResponse($responseData, [
                    'Content-Type: application/json',
                    'HTTP/1.1 200 OK',
                ]
            );
        } else {
            sendResponse(json_encode(['error' => $errorDescription]), [
                    'Content-Type: application/json',
                    $errorHeader
                ]
            );
        }
    }
}