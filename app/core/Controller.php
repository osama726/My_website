<?php
// app/core/Controller.php

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        require __DIR__ . '/../views/layouts/main.php';
        // require_once __DIR__ . '/../views/' . $view . '.php';
    }

    protected function model($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }
}
