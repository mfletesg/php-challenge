<?php
//Por seguridad del proyecto se toman los valores del archivo .env

//Este archivo lee el contenido del archivo .env, lo procesa y carga las variables de entorno en la superglobal $_ENV de php.

$envFile = __DIR__ . '/.env';
$envVars = [];

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $envVars[$key] = trim($value);
        }
    }
}

foreach ($envVars as $key => $value) {
    $_ENV[$key] = $value;
}

?>