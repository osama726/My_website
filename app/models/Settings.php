<?php
// app/models/Settings.php

require_once __DIR__ . '/../core/BaseModel.php';

class Settings extends BaseModel {
    
    // يُحدد اسم الجدول ليتعامل معه BaseModel
    public function __construct() {
        parent::__construct('settings');
    }

    /**
     * جلب الإعدادات العامة للموقع (الصف الوحيد الذي يحمل ID=1)
     * @return array|false
     */
    public function getGeneralSettings() {
        // نعتمد على أن الصف الأول والأوحيد هو الذي يحمل ID = 1
        return $this->findById(1);
    }

    /**
     * تحديث الإعدادات العامة بما في ذلك مسار الصورة
     * @param string $fullName
     * @param string $bioText
     * @param string $cvLink
     * @param string $profileImageName (مسار الصورة الجديدة أو القديمة)
     * @return bool
     */
    public function updateGeneralSettings($fullName, $bioText, $cvLink, $profileImageName, $yearsOfExperience, $currentJobStatus, $isAvailableForWork) { // 💡 تحديث المدخلات
        $sql = "UPDATE {$this->table} SET 
                full_name = ?, 
                bio_text = ?, 
                cv_link = ?,
                profile_image = ?,
                years_of_experience = ?, 
                current_job_status = ?,
                is_available_for_work = ?
                WHERE id = 1";
                
        $params = [
            $fullName, 
            $bioText, 
            $cvLink, 
            $profileImageName,
            $yearsOfExperience,        // 💡 جديد
            $currentJobStatus,         // 💡 جديد
            $isAvailableForWork        // 💡 جديد
        ];

        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            return false;
        }
    }
}