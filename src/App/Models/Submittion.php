<?php

namespace App\Models;

use Core\Database\Database;

use PDO;
use PDOException;

class Submittion
{
    private ?int $id;
    private int $brief_id;
    private int $student_id;
    private ?string $repository_url;
    private ?string $description;
    private ?string $submitted_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->brief_id = $data['brief_id'];
        $this->student_id = $data['student_id'];
        $this->repository_url = $data['repository_url'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->submitted_at = $data['submitted_at'] ?? null;
    }


    public function save()
    {
        try {

        $pdo = Database::getInstance();

        // PostgreSQL UPSERT (Includes description now)
        $sql = "INSERT INTO submissions (brief_id, student_id, repository_url, description, submitted_at) 
            VALUES (:bid, :sid, :url, :desc, NOW())
            ON CONFLICT (brief_id, student_id) 
            DO UPDATE SET 
                repository_url = EXCLUDED.repository_url, 
                description = EXCLUDED.description, 
                submitted_at = NOW()";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':bid'  => $this->brief_id,
            ':sid'  => $this->student_id,
            ':url'  => $this->repository_url,
            ':desc' => $this->description
        ]);

         return []; 
            
        } catch (PDOException $e) {
            return [
                'db' => "Database Error: " . $e->getMessage()
            ];
        }
    }

}
