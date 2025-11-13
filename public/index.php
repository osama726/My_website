<?php
    // public/index.php
    require_once __DIR__ . '/../app/config/config.php';

    //  تضمين ملف autoload لـ Composer
    require __DIR__ . '/../vendor/autoload.php';


    function renderError($code = 404, $title = 'Error', $message = null) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        http_response_code($code);

        // إعداد بيانات الخطأ لتمريرها إلى الـ layout
        $errorData = [
            'code' => $code,
            'title' => $title,
            'message' => $message ?? 'An unexpected error occurred.',
            
            //  إضافة المتغير الضروري الذي يتوقعه layouts/main.php
            'viewPath' => __DIR__ . '/../app/views/errors/error.php',
        ];

        // نمرر البيانات إلى الـ layout
        extract($errorData);

        // نعرض صفحة الخطأ من خلال layout العام
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
