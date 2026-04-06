<?php

namespace App\Models;

use App\Core\Database;

class ExamResult
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getByExamId($examId)
    {
        $stmt = $this->db->prepare("SELECT * FROM exam_results WHERE exam_id = ? ORDER BY submitted_at DESC");
        $stmt->bind_param("i", $examId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO exam_results (exam_id, student_name, answers, score) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issd", $data['exam_id'], $data['student_name'], $data['answers'], $data['score']);
        $stmt->execute();
        return $this->db->insert_id;
    }
}