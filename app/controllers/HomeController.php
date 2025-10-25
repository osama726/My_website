<?php
// app/controllers/HomeController.php
require_once __DIR__ . '/../core/Controller.php';

class HomeController extends Controller {
    public function index() {
        $this->view('home/index', [
            'title' => 'Welcome to My Portfolio',
            'message' => 'This is the home page'
        ]);
    }
}
