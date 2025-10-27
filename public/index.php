<?php
    // public/index.php
    require_once __DIR__ . '/../app/config/config.php';

    function render404($message = null) {
        // require_once __DIR__ . '/../app/config/config.php';
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // نحدد مسار view الخطأ
        $viewPath = __DIR__ . '/../app/views/errors/404.php';

        require __DIR__ . '/../app/views/layouts/main.php';
        exit;
    }

    // نجيب الـ controller و الـ action من الـ URL
    $controller = $_GET['controller'] ?? 'home';
    $action = $_GET['action'] ?? 'index';

    // نخلي الاسم الي كتبناه شبه اسم الكلاس
    $controllerName = ucfirst($controller) . 'Controller';

    // نحدد المسار الكامل للملف
    $controllerFile = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

    // نتأكد إن الملف موجود
    if (file_exists($controllerFile)) {
        require_once $controllerFile;

        // نتأكد إن الكلاس موجود
        if (class_exists($controllerName)) {
            $controllerObject = new $controllerName();

            // نتأكد إن الدالة المطلوبة موجودة
            if (method_exists($controllerObject, $action)) {
                $controllerObject->$action();
            } else {
                render404("Action '$action' not found in controller '$controllerName'");
            }
        } else {
            render404("Controller class '$controllerName' not found.");
        }
    } else {
        render404("Controller file not found: $controllerFile");
    }