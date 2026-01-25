<?php

namespace App\Controllers;

use Core\Base\Controller;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Brief;
use Core\Auth\Auth;

class TeacherController extends Controller
{
    public function index()

    
    {
        Auth::requireRole("TEACHER");
        $teacherId = $_SESSION['user_id'];

        // 1. Get Briefs
        $briefs = Brief::getActiveBriefs($teacherId);

        // 2. Prepare Static Analytics (Define here, not in Blade)
        $analytics = [
            ['label' => 'Frontend', 'perc' => 82, 'color' => 'indigo'],
            ['label' => 'Backend', 'perc' => 64, 'color' => 'emerald'],
            ['label' => 'UI/UX', 'perc' => 45, 'color' => 'pink']
        ];


        return $this->render('Teacher.dashboard.index', [
            'briefs'      => $briefs,
            'analytics'   => $analytics,
        ]);
    }
    public function ClassRoom()
    {
        Auth::requireLogin();
        $classRoom = Teacher::getTeacherClassRoom((int)$_SESSION['user_id']);
        $students = Student::getStudentsClassRoom((int)$_SESSION['user_id']);
        $this->render('Teacher.classRoom.index', [
            'class' => $classRoom,
            'studens' => $students
        ]);
    }
}
