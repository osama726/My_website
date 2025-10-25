<?php
    // public/index.php

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
                echo "Action '$action' not found in controller '$controllerName'";
            }
        } else {
            echo "Controller class '$controllerName' not found.";
        }
    } else {
        echo "Controller file '$controllerFile' not found.";
    }