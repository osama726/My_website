<?php
require_once __DIR__ . '/../core/BaseModel.php'; // استيراد الكلاس الاب BaseModel

class Message extends BaseModel {

    public function __construct()
    {
        parent::__construct('messages'); // تمرير اسم الجدول للكلاس الاب
    }

    // create new message
    public function addMessage($name, $email, $phone, $subject, $message) {
        $sql = "INSERT INTO {$this->table} (name, email, phone, subject, message) 
                VALUES (:name, :email, :phone, :subject, :message)";
        
        $stmt = $this->db->prepare($sql);
        
        // نستخدم الـNamed Parameters لضمان الأمان والترتيب
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':subject' => $subject,
            ':message' => $message
        ]);
    }

    public function findAllMessages() {
        return $this->findAll('created_at', 'DESC');
    }

    public function countUnread() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM {$this->table} WHERE is_read = 0");
        return $stmt->fetchColumn();
    }

    public function markAsRead($id) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET is_read = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    
}
