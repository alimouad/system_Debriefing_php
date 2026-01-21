<?php
namespace App\Models;
use App\Models\User;

class Student extends User {
    private ?int $classroom_id;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->classroom_id = $data['classroom_id'] ?? null;
    }

    public function role(): string {
        return 'STUDENT';
    }

    // Override save to include classroom_id
    public function save(): array {
        try {
            $pdo = \Core\Database\Database::getInstance();
            $sql = "INSERT INTO users (first_name, last_name, email, password, role, classroom_id)
                    VALUES (:f, :l, :e, :p, :r, :c)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':f' => $this->first_name,
                ':l' => $this->last_name,
                ':e' => $this->email,
                ':p' => $this->password,
                ':r' => $this->role(),
                ':c' => $this->classroom_id
            ]);
            return [];
        } catch (\PDOException $e) {
            return ['db' => $e->getMessage()];
        }
    }
}