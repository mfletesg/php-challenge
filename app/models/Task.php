<?php


require_once 'app/models/Status.php';

class Task
{

    public int $id;
    public string $title;
    public string $description;
    public int $status_id;
    public ?Status $status; // Usamos `?Status` para permitir nulos

    public function __construct(
        int $id = 0,
        string $title = '',
        string $description = '',
        int $status_id = 0,
        ?Status $status = null // Cambiado a `?Status` para aceptar un objeto Status o null

    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status_id = $status_id;
        $this->status = $status;
    }

    public static function create(int $userId, string $title, string $description, int $status_id)
    {
        $db = ConnectionDb::getInstance();
        // Sentencia preparada para prevenir inyección SQL
        $stmt = $db->prepare('INSERT INTO task (title, description, status_id, user_id) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssii', $title, $description, $status_id, $userId);
        if (!$stmt->execute()) {
            return 'Error: ' . $stmt->error;
        }
        return 'User created successfully';
    }

    public static function getAll(int $userId)
    {
        $db = ConnectionDb::getInstance();
        $stmt = $db->prepare('  SELECT t.id, t.title, t.description, t.status_id, s.id AS status_id, s.name AS status_name
                                    FROM task t 
                                INNER JOIN user u ON u.id = t.user_id
                                INNER JOIN status s on s.id = t.status_id
                                    WHERE u.id = ? ');
        $stmt->bind_param('i', $userId);

        if (!$stmt->execute()) {
            return null;
        }
        $result = $stmt->get_result(); // Obtiene el resultado como un objeto resultante de la consulta
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $status = new Status($row['status_id'], $row['status_name']);
            $task = new Task($row['id'], $row['title'], $row['description'], $row['status_id'], $status);
            $tasks[] = $task; // Añadir la instancia de Task al array $tasks
        }
        return $tasks; // Devuelve un array de objetos Task
    }

    public static function getById(int $id){
        $db = ConnectionDb::getInstance();
        $stmt = $db->prepare('  SELECT t.id, t.title, t.description, t.status_id, s.id AS status_id, s.name AS status_name
                                    FROM task t 
                                INNER JOIN user u ON u.id = t.user_id
                                INNER JOIN status s on s.id = t.status_id
                                    WHERE t.id = ? ');
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            return null;
        }
        $result = $stmt->get_result(); // Obtiene el resultado como un objeto resultante de la consulta
        $row = $result->fetch_assoc();

        if ($row) {
            $status = new Status($row['status_id'], $row['status_name']);
            $task = new Task($row['id'], $row['title'], $row['description'], $row['status_id'], $status);
            return $task; // Devuelve un array de objetos Task
        }

        return null;
        
    }

    public static function update(int $userId,  int $taskId, string $title, string $description, int $statusId){
        $db = ConnectionDb::getInstance();
        $stmt = $db->prepare(' UPDATE task SET title = ?, description = ?, status_id = ? WHERE id = ? AND user_id = ? ');
        $stmt->bind_param('ssiii', $title, $description, $statusId,  $taskId, $userId);
        if (!$stmt->execute()) {
            return null;
        }

        return 'User updated successfully';
    }

    public static function delete(int $id){
        $db = ConnectionDb::getInstance();
        $stmt = $db->prepare('DELETE FROM task WHERE id = ? ');
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            return null;
        }

        return null;
    }
}