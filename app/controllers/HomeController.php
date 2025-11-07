<?php
// app/controllers/HomeController.php
require_once __DIR__ . '/../core/Controller.php';

class HomeController extends Controller {
    public function index() {

        // 1. استدعاء الموديلز (Models) اللازمة لجلب بيانات كل قسم
        // تم استخلاص هذا المنطق من ProjectsController و SkillsController
        $projectModel = $this->model('Project'); // تحميل Project Model
        $skillModel = $this->model('Skill');   // تحميل Skill Model
        // يمكنك هنا استدعاء أي موديل آخر تحتاجه (مثل User Model لعرض بياناتك الشخصية)

        // 2. جلب البيانات من قاعدة البيانات
        // نستخدم دالة findAll التي ورثناها من BaseModel
        // للحصول على قائمة المشاريع
        $projects = $projectModel->findAll();
        $showAll = false; 

        // للحصول على قائمة المهارات
        $skills = $skillModel->findAll('id', 'DESC');

        
        $aboutData = defined('ABOUT_ME_DATA') ? ABOUT_ME_DATA : [];

        $this->view('home/index', [
            'title' => 'Welcome to My Portfolio',
            'message' => 'This is the home page',
            'projects' => $projects,
            'skills' => $skills,
            'about' => $aboutData,
            'showAll' => $showAll
        ]);
    }
}
