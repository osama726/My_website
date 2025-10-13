<?php
// app/core/BaseModel.php
require_once __DIR__ . '/Database.php';

class BaseModel {
    protected $db;
    protected $table;

    public function __construct($table) {
        $this->db = Database::getInstance();
        $this->table = $table;
    }

    // 🧩 جلب كل الصفوف
    public function findAll($orderBy = 'id', $direction = 'DESC') {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY {$orderBy} {$direction}");
        return $stmt->fetchAll();
    }

    // search users by id
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // delete user
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
