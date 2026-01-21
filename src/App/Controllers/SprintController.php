<?php 

namespace App\Controllers;
use Core\Base\Controller;
use App\Models\Sprint;
use App\Models\ClassRoom;

Class SprintController extends Controller {


    public function index() {
        $sprints  = Sprint::all();
          $this->render('Admin/sprints/index', 'adminLayout', [
            'sprints' => $sprints,
          ]);
    }

    public function create() {
        $classrooms = ClassRoom::getAll(); 
    // Initial data structure for the view
    $data = [
        'title' => '',
        'description' => '',
        'classroom_id' => '',
        'start_date' => '',
        'end_date' => '',
        'errors' => []
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. Collect and sanitize input
        $data['title']        = trim($_POST['title'] ?? '');
        $data['description']  = trim($_POST['description'] ?? '');
        $data['classroom_id'] = $_POST['classroom_id'] ?? '';
        $data['start_date']   = $_POST['start_date'] ?? '';
        $data['end_date']     = $_POST['end_date'] ?? '';

        // 2. Validate inputs
        $data['errors'] = $this->validateInputs($data);

        if (empty($data['errors'])) {
            $sprint = new Sprint($data);
            
            // 4. Attempt to save
            $saveResult = $sprint->save();

            if (empty($saveResult)) {
                header("Location: /admin/sprints");
                exit;
            } else {
                // Database error (e.g. foreign key violation)
                $data['errors']['db'] = $saveResult['db'];
            }
        }
    }


    $this->render('Admin/sprints/addSprint', 'adminLayout', [
        'data' => $data, 
        'classrooms'=> $classrooms
    ]);
}
     private function validateInputs(array $post): array
    {
        $errors = [];
        if (empty($post['title'])) $errors['TitleErr'] = 'Title is required';
         if (empty($post['description'])) $errors['descriptionErr'] = 'Title is required';
        if (empty($post['start_date'])) $errors['StartDateErr'] = 'Start date is required';
        if (empty($post['end_date'])) $errors['EndDateErr'] = 'End date is required';
        return $errors;
    }
}