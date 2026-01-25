<?php

namespace App\Models;
use App\Enums\UserRole;
use App\Models\User;
use Core\Database\Database;
use PDO;

class Teacher extends User{
    private $role = UserRole::TEACHER->value;

    public function role(): string{
        return $this->role;
    }

    public static function getTeacherBriefd(int $int){
        $pdo = Database::getInstance();
        $query = $pdo->prepare("select * from briefs where teacher_id = :id");
        $query->execute([':id' => $int]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getStudentSubmittionsByBrief(int $int){
        $pdo = Database::getInstance();
        $query = $pdo->prepare('select s.* , u.first_name , u.last_name from submissions s inner JOIN users u on s.student_id = u.id where s.brief_id = :id');
        $query->execute(["id" => $int]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTeachers(){
        $pdo = Database::getInstance();
        $query = $pdo->prepare("select * from users where role = :role");
        $query->execute([':role' => UserRole::TEACHER->value]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTeacherClassRoom(int $int){
        $pdo = Database::getInstance();
        $query = $pdo->prepare('select c.* from classrooms c inner JOIN classroom_teacher t on c.id = t.classroom_id  inner JOIN users u on t.teacher_id = u.id where u.id = :id');
        $query->execute([':id' => $int]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}