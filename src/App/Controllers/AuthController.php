<?php

namespace App\Controllers;

use Core\Base\Controller;
use Core\Helpers\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            'email'  => '',
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['email'] = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $data['errors'] = $this->validateLogin($_POST);

            if (empty($data['errors'])) {
                $user = Auth::login($data['email'], $password);

                if ($user) {
                    $redirect = null;
                    $role= $_SESSION['user_role'];
                    if ($role == 'ADMIN'){
                        $redirect = '/admin/home';
                    }
                    elseif (($role == 'TEACHER')){
                        $redirect = '/author/home';
                    }
                    else{
                        $redirect = '/';
                    }
                    header("Location: $redirect");
                    exit;
                } else {
                    $data['errors']['LoginErr'] = 'Invalid email or password';
                }
            }
        }


        $this->render('Auth/login', 'authLayout', [
            'title' => 'Login',
            'data' => $data
        ]);
    }


    public function logout()
    {
        Auth::logout();
    }



    // --- Private Helper Methods ---

    private function validateLogin(array $post): array
    {
        $errors = [];
        if (empty($post['email'])) $errors['EmailErr'] = 'Email is required';
        if (empty($post['password'])) $errors['PasswordErr'] = 'Password is required';
        return $errors;
    }
}