<?php

namespace App\Models;

use Core\Database\Database;
use PDO;
use PDOException;

class Sprint {
    private $id;
    private $title;
    private $description;
    private $classroom_id;
    private $start_date;
    private $end_date;

    public function __construct(array $data) {
        $this->id           = $data['id'] ?? null;
        $this->title        = $data['title'] ?? '';
        $this->description  = $data['description'] ?? '';
        $this->classroom_id = $data['classroom_id'] ?? null;
        $this->start_date   = $data['start_date'] ?? null;
        $this->end_date     = $data['end_date'] ?? null;
    }

    public function __get($name) {
        return $this->{$name} ?? null;
    }

    public function save(): array {
        try {
            $pdo = Database::getInstance();

            $sql = "INSERT INTO sprints (title, classroom_id, description, start_date, end_date)
                    VALUES (:title, :classroom_id, :description, :start_date, :end_date)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':title'        => $this->title,
                ':classroom_id' => (int) $this->classroom_id,
                ':description'  => $this->description,
                ':start_date'   => $this->start_date,
                ':end_date'     => $this->end_date
            ]);

            return []; 
            
        } catch (PDOException $e) {
            return [
                'db' => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public static function all(): array {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT s.*, c.name as classroom_name 
                             FROM sprints s 
                             JOIN classrooms c ON s.classroom_id = c.id 
                             ORDER BY s.start_date DESC");
        return $stmt->fetchAll();
    }
}