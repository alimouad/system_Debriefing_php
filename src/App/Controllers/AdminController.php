<?php

namespace App\Controllers;
use Core\Base\Controller;


Class AdminController extends Controller {
    public function home() {
          $this->render('Admin/dashboard/index', 'adminLayout', []);
    }



}