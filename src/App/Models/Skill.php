<?php

namespace App\Models;

use Core\Database\Database;

use PDO;
use PDOException;

class Skill
{
    private $id;
    private $code;
    private $label;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->code = $data['code'];
        $this->label = $data['label'];
    }

    public function __get($code)
    {
        return $this->{$code} ?? null;
    }

    public function save(): array
    {
        try {
            $pdo = Database::getInstance();

            $sql = "INSERT INTO skills ( code, label)
                    VALUES (:code, :label)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':code'         => $this->code,
                ':label'        => $this->label
            ]);

            return [];
        } catch (PDOException $e) {
            return [
                'db' => "Database Error: " . $e->getMessage()
            ];
        }
    }
    public static function getAll()
    {
        try {

            $pdo = Database::getInstance();
            $stmt = $pdo->query("SELECT * FROM skills");
            $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $skills;
        } catch (PDOException $e) {
            return [
                'db' => "Database Error: " . $e->getMessage()
            ];
        }
    }
}
