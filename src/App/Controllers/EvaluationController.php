<?php


namespace App\Controllers;

use App\Models\Brief;
use App\Models\Teacher;
use Core\Database\Database;
use Core\Base\Controller;
use App\Models\Evaluation;


class EvaluationController extends Controller
{
    public function index()
    {
        $id = $_GET["id"];
        $submission  = Teacher::getStudentSubmittionsByBrief($id);

        return $this->render("Teacher.evaluation.index", ['submission' => $submission]);
    }


    public function showEvaluationForm()
    {
        $briefId = $_GET['brief_id'] ?? null;
        $studentId = $_GET['student_id'] ?? null;


        $result = Brief::getStudentBrief((int)$briefId, (int)$studentId);

        if (!$result) {
            $_SESSION['error'] = "Evaluation context not found.";
            header("Location: /teacher/evaluations");
            exit;
        }

        // 3. Handle Form Submission (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evaluations = $_POST['evaluations'] ?? [];
            $teacherId = $_SESSION['user_id'];

            // Basic validation: Check if any skills were actually graded
            if (empty($evaluations)) {
                $_SESSION['error'] = "Please grade at least one skill.";
            } else {
                foreach ($evaluations as $skillId => $evalData) {
                    // Skip if no mastery level was selected for this specific skill
                    if (empty($evalData['mastery_level'])) continue;

                    $evaluation = new Evaluation([
                        'student_id'    => $studentId,
                        'teacher_id'    => $teacherId,
                        'brief_id'      => $briefId,
                        'skill_id'      => $skillId,
                        'mastery_level' => $evalData['mastery_level'],
                        'comment'       => $evalData['comment'] ?? ''
                    ]);

                    $evaluation->save();
                }

                $_SESSION['success'] = "Evaluation submitted successfully!";
                header("Location: /teacher/briefs/evaluate?id=" . $briefId);
                exit;
            }
        }

        // 4. Render the form with context
        return $this->render('Teacher.evaluation.evaluationForm', [
            'student'    => $result['context'],
            'brief'      => $result['context'],
            'submission' => $result['submission'],
            'skills'     => $result['skills']
        ]);
    }
}
