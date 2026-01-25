<?php

namespace App\Controllers;

use App\Models\Sprint;
use App\Models\Student;
use Core\Base\Controller;
use Core\Auth\Auth;


class AdminController extends Controller
{
    public function home()
    {
        Auth::requireRole("ADMIN");
        $student = Student::all();
        $sprint = Sprint::all();
        $this->render('Admin.dashboard.index', [
            'studentCount' => count($student),
            'sprintCount' => count($sprint)
        ]);
    }
}
