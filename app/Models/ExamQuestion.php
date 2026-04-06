<?php

namespace App\Models;

use App\Core\Database;

class ExamQuestion
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getByExamId($examId)
    {
        $stmt = $this->db->prepare("SELECT * FROM exam_questions WHERE exam_id = ?");
        $stmt->bind_param("i", $examId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO exam_questions (exam_id, question_text, option_a, option_b, option_c, option_d, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $data['exam_id'], $data['question_text'], $data['option_a'], $data['option_b'], $data['option_c'], $data['option_d'], $data['correct_answer']);
        $stmt->execute();
    }
}