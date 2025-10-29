<?php
// app/controllers/UserController.php
require_once __DIR__ . '/../core/Controller.php';

class UserController extends Controller {

    // 🧩 عرض صفحة تسجيل الدخول
    public function login() {
        $this->view('user/login', ['title' => 'Log in']);
    }

    // 🧩 معالجة بيانات تسجيل الدخول
    public function loginPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $userModel = $this->model('User');
            $stmt = $userModel->findByEmail($email);

            if ($stmt && password_verify($password, $stmt['password'])) {
                $_SESSION['user'] = [
                    'id' => $stmt['id'],
                    'name' => $stmt['name'],
                    'email' => $stmt['email']
                ];
                $_SESSION['flash'] = "Welcome back, {$stmt['name']}!";
                header("Location: " . BASE_URL);
                exit;
            } else {
                $_SESSION['flash'] = "Invalid email or password.";
                header("Location: " . BASE_URL . "?controller=user&action=login");
                exit;
            }
        }
    }

    // 🧩 عرض صفحة إنشاء حساب جديد
    public function register() {
        $this->view('user/register', ['title' => 'Sign up']);
    }

    // 🧩 معالجة تسجيل الحساب الجديد
    public function registerPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $phone = trim($_POST['phone']);

            $userModel = $this->model('User');

            // التحقق من وجود البريد مسبقًا
            $existing = $userModel->findByEmail($email);
            if ($existing) {
                $_SESSION['flash'] = "This email is already registered!";
                header("Location: " . BASE_URL . "?controller=user&action=register");
                exit;
            }

            // إنشاء المستخدم الجديد
            $userModel->addUser($name, $email, $password, $phone);
            $_SESSION['flash'] = "Registration successful! Please log in.";
            header("Location: " . BASE_URL . "?controller=user&action=login");
            exit;
        }
    }

    // 🧩 تسجيل الخروج
    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL);
        exit;
    }
}
