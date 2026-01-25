<?php

namespace App\Models;

use App\Models\User;
use Core\Database\Database;

class Student extends User
{
    private ?int $classroom_id;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->classroom_id = $data['classroom_id'] ?? null;
    }

    public function role(): string
    {
        return 'STUDENT';
    }

    // Override save to include classroom_id
    public function save(): array
    {
        try {
            $pdo = Database::getInstance();
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
    public static function getStudentBriefs(int $studentId): array
    {
        $pdo = Database::getInstance();

        $sql = "SELECT b.*, s.title as sprint_title, s.end_date as sprint_deadline 
            FROM users u
            INNER JOIN sprints s ON u.classroom_id = s.classroom_id
            INNER JOIN briefs b ON s.id = b.sprint_id
            WHERE u.id = :student_id
            ORDER BY s.end_date ASC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':student_id' => $studentId]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getStudentDashboardData(int $studentId): array
    {
        $pdo = Database::getInstance();

        // Get Student + Classroom + Project Count
        $sql = "SELECT c.name as classroom_name, c.year, c.id as classroom_id,
            (SELECT COUNT(*) FROM submissions WHERE student_id = u.id) as projects_done
            FROM users u
            JOIN classrooms c ON u.classroom_id = c.id
            WHERE u.id = :sid AND u.role = 'STUDENT'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':sid' => $studentId]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC) ?: [];

        if ($data) {
            // Get Recent Announcements (Briefs)
            $stmt = $pdo->prepare("SELECT b.title, b.created_at FROM briefs b 
            JOIN sprints s ON b.sprint_id = s.id 
            WHERE s.classroom_id = ? ORDER BY b.created_at DESC LIMIT 3");
            $stmt->execute([$data['classroom_id']]);
            $data['announcements'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Get Skills
            $data['skills'] = $pdo->query("SELECT * FROM skills LIMIT 6")->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public static function getBriefRenduData(int $briefId): array
    {
        $pdo = Database::getInstance();
        $studentId = $_SESSION['user_id'];

        // We start from 'briefs' to get the title even if no submission exists yet
        $sql = "SELECT 
                b.title as brief_title, 
                s.repository_url, 
                s.description, 
                s.submitted_at
            FROM briefs b
            LEFT JOIN submissions s ON b.id = s.brief_id AND s.student_id = :student_id
            WHERE b.id = :brief_id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':brief_id' => $briefId,
            ':student_id' => $studentId
        ]);

        // Use fetch() instead of fetchAll() because we only want one row for this student
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: [];
    }

    public static function getStudentsClassRoom(int $teacher_id): array
    {
        $pdo = Database::getInstance();
        $sql = "SELECT u.* FROM users u 
                INNER JOIN classrooms c ON u.classroom_id = c.id
                INNER JOIN classroom_teacher ct ON c.id = ct.classroom_id
                WHERE ct.teacher_id = :teacher_id AND u.role = 'STUDENT'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':teacher_id' => $teacher_id]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public static function all(){
        $pdo = Database::getInstance();
        $query = $pdo->prepare("select * from users where role = :role");
        $query->execute([':role' => 'STUDENT']);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}
