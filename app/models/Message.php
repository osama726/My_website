<?php
require_once __DIR__ . '/../core/BaseModel.php'; // استيراد الكلاس الاب BaseModel

class Message extends BaseModel {

    public function __construct()
    {
        parent::__construct('messages'); // تمرير اسم الجدول للكلاس الاب
    }

    // create new message
    public function addMessage($name, $email, $subject, $message) {
        $stmt = $this->db->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $subject, $message]);
    }

    
}