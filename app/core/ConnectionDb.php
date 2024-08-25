<?php

class ConnectionDb {

    private static $instance = null;

    public static function getInstance()
    {
        if (!self::$instance) {
            $host   = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_NAME'];
            $user   = $_ENV['DB_NAME'];
            $pass   = $_ENV['DB_PASS'];
            self::$instance = new PDO(`mysql:host={$host};dbname={$dbname}`, `{$user}`, `{$pass}`);
            
        }
        return self::$instance;
    }
}