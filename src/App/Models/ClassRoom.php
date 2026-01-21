<?php

namespace App\Models;
use PDO;
USE PDOException;
use Core\Database\Database;

class ClassRoom{
    private $id;
    private $name;
    private $year;

     public function __construct(array $data) {
        $this->id           = $data['id'] ?? null;
        $this->name        = $data['name'] ?? '';
        $this->year        = $data['year'] ?? '';

    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getYear(){
        return $this->year;
    }

    public static function getAll(){
        try{
        
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
    
    public function create(){
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
        
}