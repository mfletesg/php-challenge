<?php

class Task {

    public int $id;
    public string $title;
    public string $description;
    public int $status_id;

    public function __construct(
        int $id = 0,
        string $title = '', 
        string $description = '', 
        int $status_id = 0
        
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status_id = $status_id;
    }

    public static function create(string $title,  string $description, int $status_id)
    {
        $db = ConnectionDb::getInstance();
        // Sentencia preparada para prevenir inyección SQL
        $stmt = $db->prepare('INSERT INTO tasks (title, description, status_id) VALUES (?, ?, ?)');
        $stmt->bind_param('ssi', $title, $description, $status_id);
        if ($stmt->execute()) {
            return 'User created successfully';
        } else {
            return 'Error: ' . $stmt->error;
        }
    }
}