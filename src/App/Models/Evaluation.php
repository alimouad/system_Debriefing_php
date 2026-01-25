<?php

namespace App\Models;

use Core\Database\Database;
use PDO;

class Evaluation
{
    private $id;
    private $student_id;
    private $teacher_id;
    private $brief_id;
    private $skill_id;
    private $mastery_level;
    private $comment;
    private $evaluation_date;

    public function __construct($data = [])
    {
        $this->student_id = $data['student_id'] ?? null;
        $this->teacher_id = $data['teacher_id'] ?? null;
        $this->brief_id   = $data['brief_id'] ?? null;
        $this->skill_id   = $data['skill_id'] ?? null;
        $this->mastery_level = $data['mastery_level'] ?? null;
        $this->comment    = $data['comment'] ?? null;
    }

    public function save()
    {
        $pdo = Database::getInstance();

        // Ensure the columns inside (...) match the UNIQUE constraint we just created
        $sql = "INSERT INTO evaluations (student_id, teacher_id, brief_id, skill_id, mastery_level, comment) 
            VALUES (:sid, :tid, :bid, :skid, :ml, :comment)
            ON CONFLICT (student_id, brief_id, skill_id) 
            DO UPDATE SET 
                mastery_level = EXCLUDED.mastery_level, 
                comment = EXCLUDED.comment,
                teacher_id = EXCLUDED.teacher_id"; // Also update teacher_id if a different teacher regrades

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':sid'     => $this->student_id,
            ':tid'     => $this->teacher_id,
            ':bid'     => $this->brief_id,
            ':skid'    => $this->skill_id,
            ':ml'      => $this->mastery_level,
            ':comment' => $this->comment
        ]);
    }

    public function __get($name)
    {
        return $this->{$name} ?? null;
    }

    public function getStudentEvaluation(int $studentId)
    {
        $pdo = Database::getInstance();
        $sql = "SELECT 
                e.*, 
                s.label as skill_label, 
                b.title as brief_title,
                u.first_name || ' ' || u.last_name as teacher_name
            FROM evaluations e
            JOIN skills s ON e.skill_id = s.id
            JOIN briefs b ON e.brief_id = b.id
            JOIN users u ON e.teacher_id = u.id
            WHERE e.student_id = ?
            ORDER BY e.evaluation_date DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
