<?php

namespace App\Controllers;

use Core\Base\Controller;
use App\Models\Teacher;
use App\Models\Student;

class TeacherController extends Controller {
    public function index() {
        // Logic for the teacher's dashboard
         $this->render('Teacher.dashboard.index',[
        ]);
    }
    public function ClassRoom() {
        $classRoom = Teacher::getTeacherClassRoom((int)$_SESSION['user_id']);
        $students = Student::getStudentsClassRoom((int)$_SESSION['user_id']);
        $this->render('Teacher.classRoom.index',[
            'class'=> $classRoom,
            'studens'=> $students
        ]);
    }
}