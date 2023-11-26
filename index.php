<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\User;


$user = new User(1);
echo <<<EOT

<!DOCTYPE html>
<html>
    <head>
        <title>Мой первый сайт!</title>
    </head>
    <body>
        Привет {$user->email}
    </body>
</html>
EOT;
