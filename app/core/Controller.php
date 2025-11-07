<?php
// app/core/Controller.php

class Controller {
    protected function view($view, $data = []) {
        // extract($data);
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            if (function_exists('renderError')) {
                renderError(404, 'Page Not Found', "The requested page view was not found: " . $view);
            } else {
                http_response_code(404);
                require __DIR__ . '/../views/errors/error.php';
                exit;
            }
        }

        $data['viewPath'] = $viewPath;
        extract($data);

        require __DIR__ . '/../views/layouts/main.php';
        // require_once __DIR__ . '/../views/' . $view . '.php';
    }

    protected function model($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }
}
