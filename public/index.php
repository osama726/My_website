<?php
    // public/index.php
    require_once __DIR__ . '/../app/config/config.php';

    function renderError($code = 404, $title = 'Error', $message = null) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        http_response_code($code);

        // نمرر البيانات إلى صفحة الخطأ الموحدة
        $errorData = [
            'code' => $code,
            'title' => $title,
            'message' => $message ?? 'An unexpected error occurred.'
        ];

        // نمرر البيانات إلى الـ layout
        extract($errorData);

        // نعرض صفحة الخطأ من خلال layout العام
        $viewPath = __DIR__ . '/../app/views/errors/error.php';
        require __DIR__ . '/../app/views/layouts/main.php';
        exit;
    }

    // جلب controller و action من الرابط
    $controller = $_GET['controller'] ?? 'home';
    $action = $_GET['action'] ?? 'index';

    // تجهيز اسم الكلاس والمسار الكامل للملف
    $controllerName = ucfirst($controller) . 'Controller';
    $controllerFile = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

    // التحقق من وجود الملف والكلاس والدالة
    if (file_exists($controllerFile)) {
        require_once $controllerFile;

        if (class_exists($controllerName)) {
            $controllerObject = new $controllerName();

            if (method_exists($controllerObject, $action)) {
                $controllerObject->$action();
            } else {
                renderError(404, 'Page Not Found', "Action '$action' not found in controller '$controllerName'.");
            }
        } else {
            renderError(404, 'Page Not Found', "Controller class '$controllerName' not found.");
        }
    } else {
        renderError(404, 'Page Not Found', "Controller file not found: $controllerFile");
    }
