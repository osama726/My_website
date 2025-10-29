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
    public function addUser($name, $email, $password, $phone) {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, phone) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT), $phone]);
    }

    // update user
    public function updateUser($id, $name, $email, $phone) {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $phone, $id]);
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getRoleById($id) {
        $stmt = $this->db->prepare("SELECT role FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ? $row['role'] : null;
    }


    // delete user
    // public function deleteUser($id) {
    //     $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
    //     return $stmt->execute([$id]);
    // }
}
