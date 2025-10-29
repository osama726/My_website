<?php
require_once __DIR__ . '/../core/Controller.php';

class DashboardController extends Controller {

    // 🧱 الصفحة الرئيسية للوحة التحكم
    public function index() {
        $this->authorizeAdmin();

        $projectModel = $this->model('Project');
        $skillModel = $this->model('Skill');
        $userModel = $this->model('User');

        $projects = $projectModel->findAll();
        $skills = $skillModel->findAll();
        $user = $userModel->findById($_SESSION['user']['id']);

        $this->view('dashboard/index', [
            'title' => 'Dashboard',
            'user' => $user,
            'projects' => $projects,
            'skills' => $skills
        ]);
    }

    // 🧩 إدارة المشاريع (كلها في صفحة واحدة)
    public function projects() {
        $this->authorizeAdmin();
        $projectModel = $this->model('Project');

        // 🧠 الحالة 1: حذف مشروع
        if (isset($_GET['delete'])) {
            $id = (int) $_GET['delete'];
            $projectModel->delete($id);
            $_SESSION['flash'] = "🗑️ Project deleted successfully.";
            header("Location: " . BASE_URL . "?controller=dashboard&action=projects");
            exit;
        }

        // 🧠 الحالة 2: تعديل مشروع (تحميل البيانات)
        $project = null;
        if (isset($_GET['id'])) {
            $project = $projectModel->findById($_GET['id']);
        }

        // 🧠 الحالة 3: إضافة أو تعديل مشروع
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $link = trim($_POST['link']);
            $image = null;

            // ✅ رفع الصورة لو موجودة
            if (!empty($_FILES['image']['name'])) {
                $uploadDir = __DIR__ . UPLOAD_DIR;
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $imageName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $image = $imageName;
                }
            }

            // تعديل أو إضافة حسب الحالة
            if (!empty($_POST['project_id'])) {
                $id = $_POST['project_id'];
                $projectModel->updateProject($id, $title, $description, $image, $link);
                $_SESSION['flash'] = "✅ Project updated successfully.";
            } else {
                $projectModel->addProject($title, $description, $image, $link);
                $_SESSION['flash'] = "✅ Project added successfully.";
            }

            header("Location: " . BASE_URL . "?controller=dashboard&action=projects");
            exit;
        }

        // 🧠 الحالة 4: عرض كل المشاريع في الصفحة
        $projects = $projectModel->findAll();

        $this->view('dashboard/projects', [
            'title' => 'Manage Projects',
            'projects' => $projects,
            'project' => $project
        ]);
    }

    // 🔒 حماية الأدمن
    private function authorizeAdmin() {
        if (empty($_SESSION['user'])) {
            $_SESSION['flash'] = "You must log in first.";
            header("Location: " . BASE_URL . "?controller=user&action=login");
            exit;
        }

        $userModel = $this->model('User');
        $role = $userModel->getRoleById($_SESSION['user']['id']);

        if ($role !== 'admin') {
            http_response_code(403);
            $this->view('errors/403', ['title' => 'Access Denied']);
            exit;
        }
    }
}
