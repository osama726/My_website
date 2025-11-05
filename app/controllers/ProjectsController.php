// app/controllers/ProjectsController.php
<?php
require_once __DIR__ . '/../core/Controller.php';

class ProjectsController extends Controller {
    public function index() {
        $projectModel = $this->model('Project');
        // لو الموديل مش جاهز ارجع مصفوفة فارغة 
        $projects = method_exists($projectModel, 'findAll') ? $projectModel->findAll() : [];
        $showAll = true;

        $this->view('projects/index', [
            'title' => 'Projects',
            'projects' => $projects,
            'showAll' => $showAll
        ]);
    }
}
