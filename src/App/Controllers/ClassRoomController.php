<?php

namespace App\Controllers;  
use Core\Base\Controller;
use App\Models\ClassRoom;


class ClassRoomController extends Controller
{
    public function index()
    {
        $classRoom = ClassRoom::getAll();
        // $classrooms = $this->model('ClassRoom')->getAllClassRooms();
        $this->render('Admin/classroom/index','adminLayout',[
            'classrooms' => $classRoom
        ]);
    }

    public function create()
    {
        $data = [
        'name' => '',
        'year' => '',
        'errors' => []
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. Collect and sanitize input
        $data['name']  = trim($_POST['name'] ?? '');
        $data['year']  = trim($_POST['year'] ?? '');

        // 2. Validate inputs
        $data['errors'] = $this->validateInputs($data);

        if (empty($data['errors'])) {
            $classroom = new ClassRoom($data);
            
            $saveResult = $classroom->create();

            if (empty($saveResult)) {
                header("Location: /admin/classroom");
                exit;
            } else {
                $data['errors']['db'] = $saveResult['db'];
            }
        }
    }
        $this->render('Admin/classroom/addClass','adminLayout',[
            'data'       => $data
        ]);
    }

       private function validateInputs(array $post): array
    {
        $errors = [];
        if (empty($post['name'])) $errors['NameErr'] = 'Name is required';
        if (empty($post['year'])) $errors['YearErr'] = 'Year is required';
        return $errors;
    }
}