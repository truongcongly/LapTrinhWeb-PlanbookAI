<?php

namespace App\Models;

use App\Core\Database;

class ExamResult
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getByExamId($examId)
    {
        $stmt = $this->db->prepare("SELECT * FROM exam_results WHERE exam_id = ? ORDER BY submitted_at DESC");
        $stmt->execute([$examId]);
        return $stmt->fetchAll();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO exam_results (exam_id, student_name, answers, score) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['exam_id'],
            $data['student_name'],
            $data['answers'],
            $data['score']
        ]);
        return $this->db->lastInsertId();
    }
}