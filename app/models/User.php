<?php

class User {

    public int $id;
    public string $username;
    public string $password;

    public function __construct(
        int $id = 0,
        string $username = '', 
        string $password = ''
    )
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }
    
    public static function create(string $userName, string $password)
    {
        $db = ConnectionDb::getInstance();
        // Sentencia preparada para prevenir inyección SQL
        $stmt = $db->prepare('INSERT INTO user (username, password) VALUES (?, ?)');
        $stmt->bind_param('ss', $userName, $password);
        if ($stmt->execute()) {
            return 'User created successfully';
        } else {
            return 'Error: ' . $stmt->error;
        }
    }

    public static function getUserByUserName(string $userName)
    {
        $db = ConnectionDb::getInstance();
        // Sentencia preparada para prevenir inyección SQL
        $stmt = $db->prepare('SELECT id, username, password FROM user WHERE username = ? LIMIT 1');
        $stmt->bind_param('s', $userName);
        $stmt->execute();
        $result = $stmt->get_result(); // Obtiene el resultado como un objeto resultante de la consulta
        $row = $result->fetch_assoc(); // Devuelve la primera fila como un array asociativo

        if ($row) {
            // Mapear los datos a la clase User
            $user = new User($row['id'], $row['username'], $row['password']);
            return $user;
        }
        
        return null; // Retorna null si no se encuentra el usuario
        
    }
}