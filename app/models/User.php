<?php
// app/models/User.php
require_once __DIR__ . '/../core/BaseModel.php'; // استيراد الكلاس الاب BaseModel

class User extends BaseModel {
    // private $db;

    // استدعاء قاعدة البيانات عند إنشاء كائن جديد
    public function __construct() {
        parent::__construct('users'); // تمرير اسم الجدول للكلاس الاب
    }

    // get all users
    // public function getAllUsers() {
    //     $stmt = $this->db->query("SELECT * FROM users ORDER BY id DESC");
    //     return $stmt->fetchAll();
    // }

    // search users by id
    // public function getUserById($id) {
    //     $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
    //     $stmt->execute([$id]);
    //     return $stmt->fetch();
    // }

    // create new user
    public function addUser($name, $email, $password, $bio = null) {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, bio) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT), $bio]);
    }

    // update user
    public function updateUser($id, $name, $email, $bio) {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ?, bio = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $bio, $id]);
    }

    // delete user
    // public function deleteUser($id) {
    //     $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
    //     return $stmt->execute([$id]);
    // }
}
