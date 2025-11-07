<?php
require_once __DIR__ . '/../core/Controller.php';

class DashboardController extends Controller {

    // 🧱 الصفحة الرئيسية للوحة التحكم
    public function index() {
        $this->authorizeAdmin();

        $projectModel = $this->model('Project');
        $skillModel = $this->model('Skill');
        $userModel = $this->model('User');
        $messageModel = $this->model('Message'); // 💡 إضافة Message Model

        $projects = $projectModel->findAll();
        $skills = $skillModel->findAll();
        $user = $userModel->findById($_SESSION['user']['id']);
        
        // 💡 جلب عدد الرسائل غير المقروءة (نفترض وجود دالة لهذا الغرض)
        $totalUnreadMessages = $messageModel->countUnread(); 

        $this->view('dashboard/index', [
            'title' => 'Dashboard',
            'user' => $user,
            'projects' => $projects,
            'skills' => $skills,
            'totalUnreadMessages' => $totalUnreadMessages // تمرير العداد
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
            $github_link = trim($_POST['github_link']);
            $image = null;

            // ✅ رفع الصورة لو موجودة
            // ✅ مسار فعلي داخل مجلد المشروع
            $uploadDir = __DIR__ . '/../../public/uploads/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // اسم الصورة الجديد
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $imageName;

            // ✅ لو الصورة اترفعت بنجاح نحفظ اسمها فقط في قاعدة البيانات
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $image = $imageName;
            }


            // تعديل أو إضافة حسب الحالة
            if (!empty($_POST['project_id'])) {
                $id = $_POST['project_id'];
                $projectModel->updateProject($id, $title, $description, $image, $link, $github_link);
                $_SESSION['flash'] = "✅ Project updated successfully.";
            } else {
                $projectModel->addProject($title, $description, $image, $link, $github_link);
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
            $this->view('errors/error', [
                'title' => 'Access Denied',
                'code' => 403,
                'message' => 'You do not have permission to access this page.'
            ]);
            exit;
        }
    }

    // add skills management methods:
    public function skills() {
        $this->authorizeAdmin();
        $skillModel = $this->model('Skill');

        // حذف مهارة
        if (isset($_GET['delete'])) {
            $id = (int) $_GET['delete'];
            $skillModel->delete($id);
            $_SESSION['flash'] = "🗑️ Skill deleted successfully.";
            header("Location: " . BASE_URL . "?controller=dashboard&action=skills");
            exit;
        }

        // جلب مهارة واحدة لو في id (للوضع تعديل)
        $skill = null;
        if (isset($_GET['id'])) {
            $skill = $skillModel->findById($_GET['id']);
        }

        // معالجة POST لإضافة أو تعديل
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $icon = trim($_POST['icon'] ?? ''); // هنا نتوقع class للأيقونة أو نص بسيط

            if (empty($name)) {
                $_SESSION['flash'] = "Skill name is required.";
                header("Location: " . BASE_URL . "?controller=dashboard&action=skills");
                exit;
            }

            // هل ده تعديل ولا إضافة؟
            if (!empty($_POST['skill_id'])) {
                $id = (int) $_POST['skill_id'];
                $skillModel->updateSkill($id, $name, $icon);
                $_SESSION['flash'] = "✅ Skill updated successfully.";
            } else {
                $skillModel->addSkill($name, $icon);
                $_SESSION['flash'] = "✅ Skill added successfully.";
            }

            header("Location: " . BASE_URL . "?controller=dashboard&action=skills");
            exit;
        }

        // عرض كل المهارات
        $skills = $skillModel->findAll();

        $this->view('dashboard/skills', [
            'title' => 'Manage Skills',
            'skills' => $skills,
            'skill' => $skill
        ]);
    }


    // add USER management methods here
        public function users() {
        $this->authorizeAdmin(); // حماية الأدمن فقط

        $userModel = $this->model('User');

        // 🗑️ الحالة 1: حذف مستخدم
        if (isset($_GET['delete'])) {
            $id = (int) $_GET['delete'];

            // 🛡️ حماية: الأدمن لا يمكن يحذف نفسه
            if ($_SESSION['user']['id'] == $id) {
                $_SESSION['flash'] = "⚠️ You cannot delete your own account.";
                header("Location: " . BASE_URL . "?controller=dashboard&action=users");
                exit;
            }

            $userModel->delete($id);
            $_SESSION['flash'] = "🗑️ User deleted successfully.";
            header("Location: " . BASE_URL . "?controller=dashboard&action=users");
            exit;
        }

        // ✏️ الحالة 2: تعديل بيانات مستخدم
        $userData = null;
        if (isset($_GET['id'])) {
            $userData = $userModel->findById($_GET['id']);
        }

        // ➕ الحالة 3: إضافة أو تحديث مستخدم
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $role = trim($_POST['role']);
            $phone = trim($_POST['phone']);
            $password = $_POST['password'] ?? null;

            // ✅ تحقق من المدخلات
            if (empty($name) || empty($email) || empty($role)) {
                $_SESSION['flash'] = "⚠️ Please fill in all required fields.";
                header("Location: " . BASE_URL . "?controller=dashboard&action=users");
                exit;
            }

            // تعديل أم إضافة؟
            if (!empty($_POST['user_id'])) {
                $id = (int) $_POST['user_id'];
                $userModel->updateUser($id, $name, $email, $role, $phone);

                // تحديث الباسورد لو اتكتب جديد
                if (!empty($password)) {
                    $userModel->updatePassword($id, $password);
                }

                $_SESSION['flash'] = "✅ User updated successfully.";
            } else {
                // إضافة مستخدم جديد
                $userModel->addUser($name, $email, $password ?: '123456', $role, $phone);
                $_SESSION['flash'] = "✅ User added successfully.";
            }

            header("Location: " . BASE_URL . "?controller=dashboard&action=users");
            exit;
        }

        // 🧾 الحالة 4: عرض جميع المستخدمين
        $users = $userModel->getAllUsers();

        $this->view('dashboard/users', [
            'title' => 'Manage Users',
            'users' => $users,
            'userData' => $userData
        ]);
    }


    // message management method    
    public function messages() {
        $this->authorizeAdmin();
        $messageModel = $this->model('Message');
        
        // 🗑️ معالجة الحذف (Delete Action)
        if (isset($_GET['delete'])) {
            $id = (int) $_GET['delete'];
            $messageModel->delete($id);
            $_SESSION['flash'] = "🗑️ Message deleted successfully.";
            header("Location: " . BASE_URL . "?controller=dashboard&action=messages");
            exit;
        }
        
        // 💡 معالجة تحديد الرسالة كمقروءة (Mark as Read)
        if (isset($_GET['read'])) {
            $id = (int) $_GET['read'];
            // نفترض وجود دالة لتحديث حالة القراءة في Model
            $messageModel->markAsRead($id); 
            header("Location: " . BASE_URL . "?controller=dashboard&action=messages");
            exit;
        }

        // جلب كل الرسائل من الأحدث للأقدم
        $messages = $messageModel->findAll('created_at', 'DESC'); 

        $this->view('dashboard/messages', [
            'title' => 'Manage Messages',
            'messages' => $messages
        ]);
    }

}
