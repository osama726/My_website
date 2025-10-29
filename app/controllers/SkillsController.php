<?php
// app/controllers/SkillsController.php
require_once __DIR__ . '/../core/Controller.php';

class SkillsController extends Controller {

    public function index() {
        // استدعاء الموديل الخاص بالمهارات
        $skillModel = $this->model('Skill');

        // جلب كل المهارات من قاعدة البيانات (باستخدام دالة findAll من BaseModel)
        $skills = $skillModel->findAll('id', 'DESC');

        // تمرير البيانات إلى الـ View
        $this->view('skills/index', [
            'title' => 'My Skills',
            'skills' => $skills
        ]);
    }
}
