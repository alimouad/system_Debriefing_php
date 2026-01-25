<?php

namespace App\Controllers;

use App\Models\Evaluation;
use App\Models\Submittion;
use Core\Base\Controller;
use App\Models\Student;
use Core\Auth\Auth;

class StudentController extends Controller
{
    public function index()
    {
        Auth::requireRole('STUDENT');
        $id =  $_SESSION["user_id"];
        $student = Student::getStudentDashboardData($id);

        return $this->render('Student.dashboard.index', [
            'student' => $student
        ]);
    }

    public function briefRendu()
    {
        Auth::requireRole('STUDENT');
        $id = $_GET['id'] ?? null;

        $student = Student::getBriefRenduData($id);

        $data = [
            'repository_url' => '',
            'description'    => '',
            'brief_id'       => $id,
            'student_id'     => $_SESSION['user_id'] ?? '',
            'errors'         => []
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Collect and sanitize input
            $data['repository_url'] = trim($_POST['repository_url'] ?? '');
            $data['description']    = trim($_POST['description'] ?? '');
            $data['student_id']     = $_SESSION['user_id'] ?? '';
            $data['brief_id']       = $_POST['brief_id'] ?? $id; // Fix 3: Get from hidden input

            $data['errors'] = $this->validateInputs($data);

            if (empty($data['errors'])) {
                $submittion = new Submittion($data);

                // 4. Attempt to save
                $saveResult = $submittion->save();

                if (empty($saveResult)) {
                    $_SESSION['success'] = "Submission successful!";
                    header("Location: /student/briefs");
                    exit;
                } else {
                    $data['errors']['db'] = $saveResult['db'];
                }
            }
        }

        $this->render('Student.briefs.rendBrief', [
            'data' => $data,
            'student' => $student
        ]);
    }

    public function getEvaluations()
    {
        Auth::requireRole('STUDENT');
        $studentId = $_SESSION['user_id'];
        $studentEvaluations = (new Evaluation())->getStudentEvaluation($studentId);

        return $this->render('Student.evaluation.index', [
            'evaluations' => $studentEvaluations
        ]);
    }





    private function validateInputs(array $post): array
    {
        $errors = [];
        if (empty($post['repository_url'])) $errors['repository_urlErr'] = 'Repository URL is required';
        if (empty($post['description'])) $errors['descriptionErr'] = 'Description is required';
        return $errors;
    }
}
