<?php
require_once __DIR__ . '/../core/BaseModel.php'; // استيراد الكلاس الاب BaseModel

class Project extends BaseModel {

    public function __construct() {
        parent::__construct('projects'); // تمرير اسم الجدول للكلاس الاب
    }

    // create new project
    public function addProject($title, $description, $image = null, $link = null, $github_link = null) {
        $stmt = $this->db->prepare("INSERT INTO projects (title, description, image, link, github_link) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $image, $link, $github_link]);
    }

    public function updateProject($id, $title, $description, $image = null, $link = null, $github_link = null) {
        if ($image) {
            $stmt = $this->db->prepare("UPDATE projects
                SET title = ?, description = ?, image = ?, link = ?, github_link = ?
                WHERE id = ?");
            return $stmt->execute([$title, $description, $image, $link, $github_link, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE projects
                SET title = ?, description = ?, link = ?, github_link = ?
                WHERE id = ?");
            return $stmt->execute([$title, $description, $link, $github_link, $id]);
        }
    }

    public function getAllWithLimit($limit = 6) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY id DESC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}