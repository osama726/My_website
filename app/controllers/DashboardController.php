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

    // add project management methods:
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

    // general settings method
    public function settings() {
        // 1. التحقق من صلاحيات المدير
        $this->authorizeAdmin();
        
        $settingsModel = $this->model('Settings');
        $flashMessage = '';

        // 2. معالجة طلب POST (إرسال النموذج)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // جلب البيانات الأساسية
        $fullName = trim($_POST['full_name'] ?? '');
        $bioText = trim($_POST['bio_text'] ?? '');
        $cvLink = trim($_POST['current_cv_path'] ?? '');
        
        $currentImage = trim($_POST['current_profile_image'] ?? ''); 
        
        // 💡 جلب البيانات الجديدة
        $yearsOfExperience = (int)$_POST['years_of_experience'];
        $currentJobStatus = trim($_POST['current_job_status'] ?? '');
        // يتم تحويل قيمة checkbox (التي تأتي إما 'on' أو غير موجودة) إلى 1 أو 0
        $isAvailableForWork = isset($_POST['is_available_for_work']) ? 1 : 0; 
        
        $profileImageName = $currentImage; // الصورة الافتراضية هي القديمة

        $systemCvDir = __DIR__ . '/../../public/uploads/'; 

        if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] === UPLOAD_ERR_OK) {
            
            if (!is_dir($systemCvDir)) {
                mkdir($systemCvDir, 0775, true);
            }
            
            $fileType = strtolower(pathinfo($_FILES['cv_file']['name'], PATHINFO_EXTENSION));
            
            if ($fileType !== "pdf") {
                $flashMessage = "⚠️ Only PDF files are allowed for the CV.";
            } else {
                $newFileName = 'cv-' . time() . '.' . $fileType;
                $targetSystemFile = $systemCvDir . $newFileName;
                
                if (move_uploaded_file($_FILES['cv_file']['tmp_name'], $targetSystemFile)) {
                    
                    // 🗑️ حذف الملف القديم (قبل تحديث DB)
                    if (!empty($cvLink)) {
                        // يجب تحويل مسار الويب المخزن إلى مسار نظامي للحذف
                        $oldSystemPath = $systemCvDir . $cvLink; 
                        if (file_exists($oldSystemPath)) {
                            unlink($oldSystemPath); 
                        }
                    }
                    
                    // ✅ تخزين المسار الجديد في DB (مسار الويب)
                    $cvLink = $newFileName;
                    
                } else {
                    $flashMessage = "❌ Error uploading CV file. Check directory permissions (775).";
                }
            }
        }


        // 💡 معالجة رفع صورة جديدة
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            
            // 🛑 1. تعريف مسارات الرفع:
            // المسار على نظام التشغيل: يتم الخروج من (app/controllers) إلى (ROOT) ثم الدخول إلى (assets/uploads)
            $systemUploadDir = __DIR__ . '/../../public/uploads/'; 
            
            
            // تأكد أن هذا المجلد موجود وقابل للكتابة (chmod 775)
            if (!is_dir($systemUploadDir)) {
                mkdir($systemUploadDir, 0775, true);
            }
            
            $imageFileType = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            $newFileName = 'profile-' . time() . '.' . $imageFileType;
            $targetSystemFile = $systemUploadDir . $newFileName; // المسار الكامل للنظام
            
            // 2. التحقق من نوع الملف وتنفيذ الرفع
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $flashMessage = "⚠️ Sorry, only JPG, JPEG, & PNG files are allowed for the profile image.";
            } elseif (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetSystemFile)) {
                
                // ✅ تم الرفع بنجاح: الآن نخزن مسار الـHTML في قاعدة البيانات
                $profileImageName = $newFileName; 
                
                // 🗑️ حذف الصورة القديمة (للتنظيف)
                // إذا كان هناك مسار صورة قديم محفوظ في الـDB
                if (!empty($currentImage)) {
                    // نُحوِّل المسار المخزن في الـDB (مسار HTML) إلى مسار نظامي للحذف
                    $oldSystemPath = $systemUploadDir . $currentImage;
                    if (file_exists($oldSystemPath)) {
                        // نُفعّل الحذف إذا لم تكن الصورة الافتراضية
                        if ($currentImage !== 'default.jpg') 
                            unlink($oldSystemPath); 
                    }
                }
                
            } else {
                $flashMessage = "⚠️ Error uploading the new profile image. Check directory permissions (775).";
            }
        }


            // 3. تحديث البيانات في قاعدة البيانات
        if (empty($flashMessage)) { 
                
            // 🛑 استخدم try-catch هنا لكشف الخطأ الحقيقي
            try {
                $isUpdated = $settingsModel->updateGeneralSettings(
                    $fullName, 
                    $bioText, 
                    $cvLink, // هذا الآن يحمل مسار ملف الـCV
                    $profileImageName,
                    $yearsOfExperience,
                    $currentJobStatus,
                    $isAvailableForWork
                );

                if ($isUpdated) {
                    $_SESSION['flash'] = "✅ General settings updated successfully.";
                } else {
                    // لو الـUpdate لم يؤثر على أي صف (مثلاً ID=1 غير موجود)، أو فشل بدون إطلاق استثناء
                    $_SESSION['flash'] = "❌ Failed to update settings. ID=1 row not found or nothing changed.";
                }
            } catch (PDOException $e) {
                // 💡 تم اكتشاف خطأ قاعدة بيانات حقيقي!
                // اعرض رسالة الخطأ الحقيقية للمطور:
                $_SESSION['flash'] = "❌ Database Error: " . htmlspecialchars($e->getMessage());
            }

            } else {
                $_SESSION['flash'] = $flashMessage; // عرض خطأ الرفع (لو كان هناك خطأ في الرفع)
            }
            
            // 4. إعادة التوجيه
            header("Location: " . BASE_URL . "?controller=dashboard&action=settings");
            exit;
        }

        // 5. عرض الإعدادات الحالية
        $currentSettings = $settingsModel->getGeneralSettings();
        
        // إذا لم يكن هناك صف (ID=1) في الجدول، أظهر رسالة خطأ أو قم بإنشاء صف افتراضي يدوياً في البداية.
        if (!$currentSettings) {
            $_SESSION['flash'] = "❌ Settings row not found. Please insert one row with ID=1 into the 'settings' table manually.";
            $currentSettings = []; 
        }

        $this->view('dashboard/settings', [
            'title' => 'General Settings',
            'settings' => $currentSettings
        ]);
    }

}
