<?php 

namespace App\Controllers;
use Core\Base\Controller;
use App\Models\Skill;


Class SkillController extends Controller {


    public function index() {
        $skills = Skill::getAll();
          $this->render('Admin.skill.index', [
            'skills' => $skills,
          ]);
    }



       public function create() {
    // Initial data structure for the view
    $data = [
        'code' => '',
        'label' => '',
        'errors' => []
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. Collect and sanitize input
        $data['code']        = trim($_POST['code'] ?? '');
        $data['label']  = trim($_POST['label'] ?? '');

        // 2. Validate inputs
        $data['errors'] = $this->validateInputs($data);

        if (empty($data['errors'])) {
            $skill = new Skill($data);
            
            // 4. Attempt to save
            $saveResult = $skill->save();

            if (empty($saveResult)) {
                $_SESSION['success'] = "The new skill has been created successfully!";
                header("Location: /admin/skills");
                exit;
            } else {
                // Database error (e.g. foreign key violation)
                $data['errors']['db'] = $saveResult['db'];
            }
        }
    }


    $this->render('Admin.skill.addSkill', [
        'data' => $data, 
    ]);
}
     private function validateInputs(array $post): array
    {
        $errors = [];
        if (empty($post['code'])) $errors['CodeErr'] = 'Code is required';
         if (empty($post['label'])) $errors['LabelErr'] = 'Label is required';
        return $errors;
    }
}