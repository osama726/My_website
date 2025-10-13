<?php
require_once __DIR__ . '/../core/BaseModel.php'; // استيراد الكلاس الاب BaseModel

class Project extends BaseModel {

    public function __construct() {
        parent::__construct('projects'); // تمرير اسم الجدول للكلاس الاب
    }

    // create new project
    public function addProject($title, $description, $image, $link) {
        $stmt =$this->db->prepare("INSERT INTO projects (title, description, image, link) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $image, $link]);
    }

    public function updateProject($id, $title, $description, $image, $link) {
        $stmt = $this->db->prepare("UPDATE projects
        SET title = ?, description = ?, image = ?, link = ?
        WHERE id = ?");
        return $stmt->execute([$title, $description, $image, $link, $id]);

    }
}