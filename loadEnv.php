<?php
/**
 * Este archivo lee el contenido del archivo .env, lo procesa y carga las variables de entorno en la superglobal $_ENV de php.
 */

define('BASE_PATH', realpath(dirname(__FILE__)));

// Determinar el protocolo (HTTP o HTTPS)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
// Construir la URL base
define('BASE_URL', $protocol . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));

/*
    Por motivos de seguridad del proyecto, los valores se obtienen del archivo .env. 
    
    En este caso, para fines de prueba, se han definido valores por defecto para las variables de entorno. 
    Sin embargo, en proyectos reales no es recomendable incluir credenciales de acceso directamente 
    en el código, ya que esto puede comprometer la seguridad.
*/
$defaultEnvVars = [
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'challengeDb',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'BASE_URL'=> 'php-challenge',
    'KEY_ENCRYPTER' => 'aeQejNaDKSN@!-f'
];

$envFile = __DIR__ . '/.env';
$envVars = $defaultEnvVars;

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $envVars[$key] = trim($value);
        }
    }
}

// Establecer las variables de entorno
foreach ($envVars as $key => $value) {
    $_ENV[$key] = $value;
}
