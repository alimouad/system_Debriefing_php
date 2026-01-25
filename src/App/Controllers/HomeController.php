<?php

namespace App\Controllers;

use Core\Base\Controller;

class HomeController extends Controller
{
    public function index()
    {
        
        $this->render('auth.login.view', [ ]);
    }


}