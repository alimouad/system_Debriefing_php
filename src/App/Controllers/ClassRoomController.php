<?php

namespace App\Controllers;

use Core\Base\Controller;
use App\Models\ClassRoom;
use Core\Auth\Auth;
use App\Models\Teacher;

class ClassRoomController extends Controller
{
    public function index()
    {
        Auth::requireRole("ADMIN");
        $classRoom = ClassRoom::getAll();
        // $classrooms = $this->model('ClassRoom')->getAllClassRooms();
        $this->render('Admin.classroom.index', [
            'classrooms' => $classRoom
        ]);
    }

    public function create()
    {
        Auth::requireRole("ADMIN");
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
                    $_SESSION['success'] = "The new classroom has been created successfully!";
                    header("Location: /admin/classroom");
                    exit;
                } else {
                    $data['errors']['db'] = $saveResult['db'];
                }
            }
        }
        $this->render('Admin.classroom.addClass', [
            'data'       => $data
        ]);
    }

    public function assignTeacher()
    {
        Auth::requireRole("ADMIN");
        $id = $_GET['id'] ?? '';
        $teachers = Teacher::getTeachers();
        $classroom = ClassRoom::getClassroom($id);
        return $this->render('Admin.classroom.assignTeacher', [
            'teachers'  => $teachers,
            'classroom' => $classroom
        ]);
    }
    public function processAssignment()
    {
        Auth::requireRole("ADMIN");
        $classId = (int)$_POST['classroom_id'];
        $teacherId = (int)$_POST['teacher_id'];

        $success = Classroom::handleAssignment($classId, $teacherId);

        if ($success) {
            $_SESSION['success'] = "Teacher successfully assigned!";
        } else {
            $_SESSION['error'] = "Failed to assign teacher. Please try again.";
        }

        header("Location: /admin/classroom");
        exit;
    }

    private function validateInputs(array $post): array
    {
        $errors = [];
        if (empty($post['name'])) $errors['NameErr'] = 'Name is required';
        if (empty($post['year'])) $errors['YearErr'] = 'Year is required';
        return $errors;
    }
}
