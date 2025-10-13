<?php
require_once __DIR__ . '/../core/BaseModel.php'; // استيراد الكلاس الاب BaseModel

class Skill extends BaseModel {

    public function __construct()
    {
        parent::__construct('skills'); // تمرير اسم الجدول للكلاس الاب
    }

    // create new skill
    public function addSkill($name, $icon = null) {
        $stmt = $this->db->prepare("INSERT INTO
            skills (name, icon) VALUES (?, ?)");
        return $stmt->execute([$name, $icon]);
    }

    public function updateSkill($id, $name, $icon) {
        $stmt = $this->db->prepare("UPDATE skills
            SET name = ?, icon = ?
            WHERE id = ?");
        return $stmt->execute([$id, $name, $icon]);

    }
}