<?php

class Task
{

    public int $id;
    public string $title;
    public string $description;
    public int $status_id;

    public function __construct(
        int $id = 0,
        string $title = '',
        string $description = '',
        int $status_id = 0

    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status_id = $status_id;
    }

    public static function create(int $userId, string $title, string $description, int $status_id)
    {
        $db = ConnectionDb::getInstance();
        // Sentencia preparada para prevenir inyección SQL
        $stmt = $db->prepare('INSERT INTO tasks (title, description, status_id) VALUES (?, ?, ?)');
        $stmt->bind_param('ssi', $title, $description, $status_id);
        if (!$stmt->execute()) {
            return 'Error: ' . $stmt->error;
        }

        $taskId = $stmt->insert_id;
        $stmt = $db->prepare('INSERT INTO users_tasks (user_id, task_id) VALUES (?, ?)');
        $stmt->bind_param('ii', $userId, $taskId);
        if (!$stmt->execute()) {
            return 'Error: ' . $stmt->error;
        }

        return 'User created successfully';
    }

    public static function getAll(int $userId)
    {
        $db = ConnectionDb::getInstance();
        $stmt = $db->prepare('  SELECT t.id, t.title, t.description, t.status_id, s.name
                                FROM tasks t 
                                INNER JOIN users_tasks ut ON t.id = ut.task_id 
                                INNER JOIN status s on s.id = t.status_id
                                WHERE ut.user_id = ? ');
        $stmt->bind_param('i', $userId);

        if (!$stmt->execute()) {
            return null;
        }
        

        $result = $stmt->get_result(); // Obtiene el resultado como un objeto resultante de la consulta
        $row = $result->fetch_assoc(); // Devuelve la primera fila como un array asociativo

        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            // Mapear los datos a la clase Task
            $task = new Task($row['id'], $row['title'], $row['description'], $row['status_id']);
            $tasks[] = $task; // Añadir la instancia de Task al array $tasks
        }
        return $tasks; // Devuelve un array de objetos Task
    }
}