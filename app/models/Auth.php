<?php

require 'app/core/ConnectionDb.php'; //Conexion a la base de datos

class Auth {

    public static function get()
    {
        $db = ConnectionDb::getInstance();
        // Sentencia preparada para prevenir inyección SQL
        $stmt = $db->prepare('SELECT * FROM user');
        $stmt->execute();
        $result = $stmt->get_result(); // Obtiene el resultado como un objeto resultante de la consulta
        return $result->fetch_all(MYSQLI_ASSOC); // Devuelve todas las filas como un array asociativo
    }

    public static function create(){
        return 'ok';
    }
}