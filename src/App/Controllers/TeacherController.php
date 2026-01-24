<?php

namespace App\Controllers;

use Core\Base\Controller;

class TeacherController extends Controller {
    public function index() {
        // Logic for the teacher's dashboard
         $this->render('Teacher.dashboard.index',[
        ]);
    }
}