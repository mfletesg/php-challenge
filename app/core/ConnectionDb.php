<?php

class ConnectionDb
{

    private static $instance = null;

    public static function getInstance()
    {
        if (!self::$instance) {
            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $pass = $_ENV['DB_PASS'];

            self::$instance = new mysqli($host, $user, $pass, $dbname);

             // Verificar la conexión
             if (self::$instance->connect_error) {
                die("Error de conexión: " . self::$instance->connect_error);
            }

            // Establecer el charset a utf8mb4
            self::$instance->set_charset('utf8mb4');
        }
        return self::$instance;
    }
}