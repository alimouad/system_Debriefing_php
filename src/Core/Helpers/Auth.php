<?php

namespace Core\Helpers;

use Core\Database\Database;

  class Auth{
    public static function login(string $email, string $password): bool{
        if(empty($email) || empty($password)){
            return false;
        }
        
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(["email" => $email]);
        $user = $stmt->fetch();

        if(empty($user)){
            $_SESSION['ERROR_MESSAGE'] = "Invalid credentials";
            return false;
        }
        
        if(!password_verify($password, $user["password"])){
            $_SESSION['ERROR_MESSAGE'] = "Invalid password";
            return false;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id']   = (int) $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_name'] = $user['first_name'];

        return true;

    }


       public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
    // public static function check(): bool{
    //     if (!Session::has('user_id')) {
    //         return false;
    //     }

    //     $user_id = Session::get('user_id');

    //     $db = Database::getInstance();

    //     $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    //     $stmt->execute(["id" => $user_id]);
    //     $user = $stmt->fetch();

    //     if($user){
    //         return true;
    //     }

    //     return false;
    // }


}