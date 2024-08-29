<?php

class Status
{
    public int $id;
    public string $name;

    public function __construct(
        int $id = 0,
        string $name = '',

    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function getAll(){
        $db = ConnectionDb::getInstance();
        $stmt = $db->prepare('SELECT id, name FROM status');
        if (!$stmt->execute()) {
            return null;
        }
        $result = $stmt->get_result();
        $status = [];
        while ($row = $result->fetch_assoc()) {
            $s = new Status($row['id'], $row['name']);
            $status[] = $s;
        }
        return $status;
    }
}