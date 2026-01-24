<?php

namespace App\Controllers;

use Core\Base\Controller;

class NotFoundController extends Controller
{
    public function index()
    {
        // Set HTTP response code to 404
        http_response_code(404);
        
        // If you have a 404 blade view:
        return $this->render('errors.404');

    }
}