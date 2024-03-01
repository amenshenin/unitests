<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Calc;
use App\Connection;
use App\User;

$calc = new Calc();
print_r($calc->plus(1,2));
print_r(PHP_EOL);
$user = new User(Connection::getInstance());
$author = $user->find(1);
print_r("User Id: {$author->user_id}" . PHP_EOL . "Email: {$author->email}" . PHP_EOL . "Age: {$author->age}" . PHP_EOL);
