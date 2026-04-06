<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class LessonPlan {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function allByTeacher($teacherId) {
        $stmt = $this->db->prepare(
            "SELECT lp.*, cf.title AS framework_name
             FROM lesson_plans lp
             JOIN curriculum_frameworks cf ON lp.framework_id = cf.id
             WHERE teacher_id = ?"
        );
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO lesson_plans(
                framework_id, teacher_id, objective,
                activities, assessment, status
            ) VALUES (?, ?, ?, ?, ?, ?)"
        );

        return $stmt->execute([
            $data['framework_id'],
            $data['teacher_id'],
            $data['objective'],
            $data['activities'],
            $data['assessment'],
            $data['status']
        ]);
    }
}