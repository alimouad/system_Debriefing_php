<?php

namespace App\Models;

use Core\Database\Database;
use DateTime;
use PDOException;

abstract class User
{
    protected ?int $id;
    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $password;
    protected ?DateTime $created_at;

    public function __construct(array $data)
    {
        $this->id         = $data['id'] ?? null;
        $this->first_name = $data['first_name'] ?? '';
        $this->last_name  = $data['last_name'] ?? '';
        $this->email      = $data['email'] ?? '';
        $this->password   = $data['password'] ?? '';
        $this->created_at = isset($data['created_at']) ? new DateTime($data['created_at']) : new DateTime();
    }

    // Force subclasses to define their role (e.g., 'TEACHER' or 'STUDENT')
    abstract public function role(): string;

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getFirstName(): string
    {
        return $this->first_name;
    }
    public function getLastName(): string
    {
        return $this->last_name;
    }
    public function getFullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    public function save(): array
    {
        try {
            $pdo = Database::getInstance();

            $sql = "INSERT INTO users (first_name, last_name, email, password, role, created_at)
                    VALUES (:first_name, :last_name, :email, :password, :role, :created_at)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':first_name' => $this->first_name,
                ':last_name'  => $this->last_name,
                ':email'      => $this->email,
                ':password'   => $this->password, // Ensure this is hashed before calling save
                ':role'       => $this->role(),
                ':created_at' => $this->created_at->format('Y-m-d H:i:s')
            ]);

            $this->id = (int)$pdo->lastInsertId();

            return [];
        } catch (PDOException $e) {
            return ['db' => "Database Error: " . $e->getMessage()];
        }
    }
    public static function allWithClassroom(): array
    {
        try {
            $pdo = Database::getInstance();
            // We use LEFT JOIN so Teachers (who have no classroom_id) still appear
            $sql = "SELECT users.*, classrooms.name as classroom_name 
                FROM users 
                LEFT JOIN classrooms ON users.classroom_id = classrooms.id 
                where users.role IN ('TEACHER', 'STUDENT')
                ORDER BY users.role DESC, users.last_name ASC";

            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
}
