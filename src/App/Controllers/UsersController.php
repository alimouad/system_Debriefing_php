<?php 

namespace App\Controllers;
use Core\Base\Controller;
use App\Models\ClassRoom;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;


class UsersController extends Controller {
    public function index() {
    $users = User::allWithClassroom();
    
    $this->render('Admin/users/index', 'adminLayout', [
        'users' => $users
    ]);
}

    public function create() {
        // Fetch classrooms for the student dropdown
        $classrooms = ClassRoom::getAll(); 
        
        $data = [
            'first_name'   => '',
            'last_name'    => '',
            'email'        => '',
            'role'         => '',
            'password'     => '',
            'classroom_id' => '',
            'errors'       => []
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Collect and sanitize input
            $data['first_name']   = trim($_POST['first_name'] ?? '');
            $data['last_name']    = trim($_POST['last_name'] ?? '');
            $data['email']        = trim($_POST['email'] ?? '');
            $data['password']     = $_POST['password'] ?? ''; // Don't trim passwords (spaces can be intentional)
            $data['classroom_id'] = $_POST['classroom_id'] ?? null;
            $data['role'] = strtoupper(trim($_POST['role'] ?? ''));

            $data['errors'] = $this->validateUserInputs($data);

            if (empty($data['errors'])) {
                // 3. Hash the password for security
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

                // 4. Instantiate the correct subclass
                if ($data['role'] === 'STUDENT') {
                    $user = new Student($data);
                } else {
                    $user = new Teacher($data);
                }
                
                // 5. Save
                $saveResult = $user->save();

                if (empty($saveResult)) {
                    header("Location: /admin/users");
                    exit;
                } else {
                    $data['errors']['db'] = $saveResult['db'];
                }
            }
        }

        $this->render('Admin/users/addUser', 'adminLayout', [
            'classrooms' => $classrooms,
            'data' => $data 
        ]);
    }

    private function validateUserInputs(array $post): array {
        $errors = [];
        if (empty($post['first_name'])) $errors['FirstNameErr'] = 'First name is required';
        if (empty($post['last_name'])) $errors['LastNameErr'] = 'Last name is required';
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) $errors['EmailErr'] = 'Valid email is required';
        if (strlen($post['password']) < 6) $errors['PassErr'] = 'Password must be at least 6 characters';
        if (empty($post['role'])) $errors['RoleErr'] = 'Please select a role';
        
        // If student, check classroom
        if ($post['role'] === 'STUDENT' && empty($post['classroom_id'])) {
            $errors['ClassErr'] = 'Students must be assigned to a classroom';
        }
        
        return $errors;
    }
}