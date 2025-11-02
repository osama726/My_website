<?php
require_once __DIR__ . '/../core/BaseModel.php';

class User extends BaseModel {

    
    public function __construct() {
        parent::__construct('users');
    }

    /* ✅ إضافة مستخدم جديد (من لوحة التحكم أو التسجيل) */
    public function addUser($name, $email, $password,  $phone = null, $role = 'user') {
        $stmt = $this->db->prepare("
            INSERT INTO users (name, email, password, phone, role)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $name,
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            $phone,
            $role
        ]);
    }

    /* ✅ تحديث بيانات مستخدم (بدون تغيير الباسورد) */
    public function updateUser($id, $name, $email, $role, $phone = null) {
        $stmt = $this->db->prepare("
            UPDATE users
            SET name = ?, email = ?, phone = ?, role = ?
            WHERE id = ?
        ");
        return $stmt->execute([$name, $email, $phone, $role, $id]);
    }

    /* ✅ تحديث كلمة السر فقط */
    public function updatePassword($id, $newPassword) {
        $stmt = $this->db->prepare("
            UPDATE users SET password = ? WHERE id = ?
        ");
        return $stmt->execute([password_hash($newPassword, PASSWORD_DEFAULT), $id]);
    }

    /* ✅ جلب كل المستخدمين */
    public function getAllUsers($orderBy = 'id', $direction = 'DESC') {
        $stmt = $this->db->query("SELECT id, name, email, role, phone FROM users ORDER BY {$orderBy} {$direction}");
        return $stmt->fetchAll();
    }

    /* ✅ جلب مستخدم حسب الإيميل */
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /* ✅ جلب دور المستخدم */
    public function getRoleById($id) {
        $stmt = $this->db->prepare("SELECT role FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        return $user ? $user['role'] : null;
    }
    
}
