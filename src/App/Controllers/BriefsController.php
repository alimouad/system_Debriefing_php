<?php 


namespace App\Controllers;

use App\Models\Brief;
use Core\Base\Controller;
use App\Models\ClassRoom;
use App\Models\Skill;
use App\Models\Sprint;
use App\Models\Teacher;
use Core\Auth\Auth;
use App\Models\Student;

class BriefsController extends Controller {
    
    
    public function index() {
        Auth::requireRole("TEACHER");
        $teacherBriefs = Teacher::getTeacherBriefd($_SESSION['user_id']);

        $this->render('Teacher.briefs.index', [
            'teacherBriefs' => $teacherBriefs,
        ]);
    }
  
    public function create() {
        Auth::requireRole("TEACHER");
        // Mock data for the form selects
        $classrooms = Classroom::getAll();
        $sprints = Sprint::all();
        $skills = Skill::getAll();

         $data = [
        'title' => '',
        'description' => '',
        'estimated_duration' => '',
        'brief_type' => '',
        'sprint_id' => '',
        'teacher_id' => '',
        'skills' => [],
        'errors' => []
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. Collect and sanitize input
        $data['title']        = trim($_POST['title'] ?? '');
        $data['description']  = trim($_POST['description'] ?? '');
        $data['estimated_duration'] = $_POST['estimated_duration'] ?? '';
        $data['brief_type']   = $_POST['brief_type'] ?? '';
        $data['sprint_id']    = $_POST['sprint_id'] ?? '';
        $data['teacher_id']   = $_SESSION['user_id'] ?? '';
        $data['skills']       = $_POST['skills'] ?? [];

        // 2. Validate inputs
        $data['errors'] = $this->validateInputs($data);

        if (empty($data['errors'])) {
            $brief = new Brief($data);
            
            // 4. Attempt to save
            $saveResult = $brief->save();

            if (empty($saveResult)) {
                $_SESSION['success'] = "The new brief has been launched successfully!";
                header("Location: /teacher/briefs");
                exit;
            } else {
                // Database error (e.g. foreign key violation)
                $data['errors']['db'] = $saveResult['db'];
            }
        }
    }




        $this->render('Teacher.briefs.addBrief', [
            'data' => $data,
            'classrooms' => $classrooms,
            'sprints' => $sprints,
            'skills' => $skills
        ]);
    }


    public function getStudentBriefs(){
        
        $studentBriefs = Student::getStudentBriefs($_SESSION['user_id']);

        return $this->render('Student.briefs.index', [
            'briefs' => $studentBriefs,
        ]);
    }


    private function validateInputs(array $post): array
    {
        $errors = [];
        if (empty($post['title'])) $errors['TitleErr'] = 'Title is required';
         if (empty($post['description'])) $errors['descriptionErr'] = 'Title is required';
        if (empty($post['estimated_duration'])) $errors['estimated_durationErr'] = 'Estimated duration is required';
        if (empty($post['brief_type'])) $errors['brief_typeErr'] = 'Brief typeqqqqq is required';
        return $errors;
    }
}