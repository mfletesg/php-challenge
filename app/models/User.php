<?php

// require 'app/core/ConnectionDb.php'; //Conexion a la base de datos



class User {


    const User = "user";
    
    public static function create($userName, $password)
    {
        $db = ConnectionDb::getInstance();
        $stmt = $db->prepare('INSERT INTO User (username, password) VALUES (?, ?)');
        $stmt->bind_param('ss', $userName, $password);
        if ($stmt->execute()) {
            return 'User created successfully';
        } else {
            return 'Error: ' . $stmt->error;
        }
    }
}