<?php

require_once '../vendor/autoload.php';
require_once '../src/functions/functions.php';

use App\Controller\CalculatorController;
use App\Exception\StringException;
use App\Validator\Validator;

$mathSigns = [
    '+' => 'add',
    '-' => 'sub',
    '*' => 'mul',
    '/' => 'div',
];


$params = getQueryParams($_SERVER['REQUEST_URI']);

// sanitize data;
$digitOne = htmlspecialchars(trim($params['digitOne']));
$digitTwo = htmlspecialchars(trim($params['digitTwo']));
$mathSign = $mathSigns[htmlspecialchars(trim($params['mathSign']))];

// validator
$validator = new Validator();

try {
    if (!$validator->operandIsFloat($digitOne)) {
        throw new StringException('Operand is a string', $digitOne);
    }

    if (!$validator->operandIsFloat($digitTwo)) {
        throw new StringException('Operand is a string', $digitTwo);
    }

    $controller = new CalculatorController();
    $controller->resultAction($mathSign, $digitOne, $digitTwo);

} catch (\Throwable $exception) {
    echo $exception->getMessage();
}
