<?php

namespace App\Models;

use PDO;
use PDOException;
use Core\Database\Database;

class ClassRoom
{
    private $id;
    private $name;
    private $year;

    public function __construct(array $data)
    {
        $this->id           = $data['id'] ?? null;
        $this->name        = $data['name'] ?? '';
        $this->year        = $data['year'] ?? '';
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getYear()
    {
        return $this->year;
    }

    public static function getAll()
    {
        try {

            $pdo = Database::getInstance();
            $stmt = $pdo->query("SELECT * FROM classrooms");
            $classrooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $classrooms;
        } catch (PDOException $e) {
            return [
                'db' => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public function create()
    {
        try {
            $pdo = Database::getInstance();

            $sql = "INSERT INTO classrooms (name, year)
                    VALUES (:name, :year)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':name'         => $this->name,
                ':year'         => $this->year
            ]);

            return [];
        } catch (PDOException $e) {
            return [
                'db' => "Database Error: " . $e->getMessage()
            ];
        }
    }

    public static function getClassroom(int $id)
    {
        $pdo = Database::getInstance();
        $sql = "select * from classrooms where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function handleAssignment(int $classId, int $teacherId): bool
    {
        $pdo = Database::getInstance();

        try {
            $pdo->beginTransaction();

            // 1. Remove existing assignment for this classroom
            $deleteStmt = $pdo->prepare("DELETE FROM classroom_teacher WHERE classroom_id = ?");
            $deleteStmt->execute([$classId]);

            // 2. Insert the new assignment
            $insertStmt = $pdo->prepare("INSERT INTO classroom_teacher (classroom_id, teacher_id) VALUES (?, ?)");
            $insertStmt->execute([$classId, $teacherId]);

            return $pdo->commit();
        } catch (\Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            // Log the error for the developer
            error_log("Assignment Error: " . $e->getMessage());
            return false;
        }
    }
}
