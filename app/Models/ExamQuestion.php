<?php

namespace App\Models;

use App\Core\Database;

class ExamQuestion
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($examId, $questionId)
    {
        $examId = (int)$examId;
        $questionId = (int)$questionId;

        $sql = "INSERT INTO exam_questions (exam_id, question_id) VALUES ($examId, $questionId)";
        return $this->conn->query($sql);
    }

    public function deleteByExamId($examId)
    {
        $examId = (int)$examId;
        return $this->conn->query("DELETE FROM exam_questions WHERE exam_id = $examId");
    }

    public function getQuestionIdsByExam($examId)
    {
        $examId = (int)$examId;
        $result = $this->conn->query("SELECT question_id FROM exam_questions WHERE exam_id = $examId");

        $ids = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $ids[] = (int)$row['question_id'];
            }
        }

        return $ids;
    }

    public function getQuestionsByExam($examId)
    {
        $examId = (int)$examId;

        $sql = "SELECT q.*
                FROM exam_questions eq
                INNER JOIN questions q ON eq.question_id = q.id
                WHERE eq.exam_id = $examId
                ORDER BY eq.id ASC";

        $result = $this->conn->query($sql);

        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }

        return $items;
    }
}