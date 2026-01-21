<?php 

namespace App\Controllers;
use Core\Base\Controller;

Class SkillController extends Controller {
    public function index() {
          $this->render('Admin/skills/index', 'adminLayout', []);
    }

    public function create() {
        $this->render('Admin/skills/addSkill','adminLayout', []);
    }
}