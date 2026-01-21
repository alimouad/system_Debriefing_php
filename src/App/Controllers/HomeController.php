<?php

namespace App\Controllers;

use App\Services\ArticleService;
use Core\Base\Controller;

class HomeController extends Controller
{
    public function index()
    {
        
        $this->render('auth/login.view', 'layout_main', [ ]);
    }


}