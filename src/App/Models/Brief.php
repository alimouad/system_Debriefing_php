<?php

namespace App\Models;

use Core\Database\Database;
use PDO;
use PDOException;



class Brief
{
    // Properties matching your SQL schema
    private $id;
    private $title;
    private $description;
    private $estimated_duration;
    private $brief_type;
    private $sprint_id;
    private $teacher_id;
    private $skills = [];

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'] ?? '';
        $this->description = $data['description'] ?? '';

        $this->estimated_duration = $data['estimated_duration'] ?? '';
        $this->brief_type = $data['brief_type'] ?? 'INDIVIDUAL';
        $this->teacher_id = $data['teacher_id'] ?? ($_SESSION['user_id'] ?? null);
        $this->sprint_id = $data['sprint_id'] ?? null;
        $this->skills = $data['skills'] ?? [];
    }

    public function save(): array
    {
        try {
            $pdo = Database::getInstance();
            $pdo->beginTransaction(); // Start transaction for safety

            // 1. Insert the Brief
            $sql = "INSERT INTO briefs (title, description, estimated_duration, brief_type, sprint_id, teacher_id)
                    VALUES (:title, :description, :estimated_duration, :brief_type, :sprint_id, :teacher_id)
                    RETURNING id";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':title'              => $this->title,
                ':description'        => $this->description,
                ':estimated_duration' => $this->estimated_duration,
                ':brief_type'         => $this->brief_type,
                ':sprint_id'          => (int) $this->sprint_id,
                ':teacher_id'         => (int) $this->teacher_id
            ]);

            $briefId = $stmt->fetchColumn();

            // 2. Insert Skills into the pivot table (assuming table name: brief_skills)
            if (!empty($this->skills) && $briefId) {
                $skillSql = "INSERT INTO brief_skill (brief_id, skill_id) VALUES (:brief_id, :skill_id)";
                $skillStmt = $pdo->prepare($skillSql);

                foreach ($this->skills as $skillId) {
                    $skillStmt->execute([
                        ':brief_id' => $briefId,
                        ':skill_id' => (int) $skillId
                    ]);
                }
            }

            $pdo->commit();
            return [];
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            return ['db' => "Database Error: " . $e->getMessage()];
        }
    }

    public static function all(): array
    {
        $pdo = Database::getInstance();
        $sql = "SELECT b.*, s.title as sprint_title, cl.name as classroom_name,
                (SELECT COUNT(*) FROM brief_skills bs WHERE bs.brief_id = b.id) as skill_count
                FROM briefs b
                JOIN sprints s ON b.sprint_id = s.id
                JOIN classrooms cl ON s.classroom_id = cl.id
                ORDER BY b.id DESC";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getStudentBrief(int $briefId, int $studentId): ?array
    {
        $pdo = Database::getInstance();

        // 1. Get Brief & Student Context
        $ctxStmt = $pdo->prepare("
        SELECT b.id as brief_id, b.title as brief_title, u.id as student_id, u.first_name, u.last_name 
        FROM briefs b
        CROSS JOIN users u 
        WHERE b.id = :bid AND u.id = :sid
    ");
        $ctxStmt->execute(['bid' => $briefId, 'sid' => $studentId]);
        $context = $ctxStmt->fetch(\PDO::FETCH_ASSOC);

        // If no context found, return null (Controller will handle the redirect)
        if (!$context) {
            return null;
        }

        // 2. Get the student's submission (The work to be graded)
        $subStmt = $pdo->prepare("SELECT repository_url, description FROM submissions WHERE brief_id = ? AND student_id = ?");
        $subStmt->execute([$briefId, $studentId]);
        $submission = $subStmt->fetch(\PDO::FETCH_ASSOC);

        // 3. Get Skills linked to this brief via the junction table
        $skillsStmt = $pdo->prepare("
        SELECT s.id, s.code, s.label 
        FROM skills s
        JOIN brief_skill bs ON s.id = bs.skill_id
        WHERE bs.brief_id = ?
    ");
        $skillsStmt->execute([$briefId]);
        $skills = $skillsStmt->fetchAll(\PDO::FETCH_ASSOC);

        // 4. Return everything as a single package
        return [
            'context'    => $context,
            'submission' => $submission ?: ['repository_url' => '', 'description' => 'No notes provided.'],
            'skills'     => $skills
        ];
    }

    public static function getActiveBriefs(int $id)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT b.* FROM briefs b JOIN classroom_teacher c ON b.teacher_id = c.teacher_id WHERE b.teacher_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
    }
}
