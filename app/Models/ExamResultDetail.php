<?php

namespace App\Models;

use App\Core\Database;

class ExamResultDetail
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($data)
    {
        $resultId = (int)$data['result_id'];
        $questionNumber = (int)$data['question_number'];
        $studentAnswer = $this->conn->real_escape_string($data['student_answer'] ?? '');
        $correctAnswer = $this->conn->real_escape_string($data['correct_answer'] ?? '');
        $isCorrect = !empty($data['is_correct']) ? 1 : 0;
        $confidence = isset($data['confidence']) && $data['confidence'] !== null ? (float)$data['confidence'] : 'NULL';
        $note = $this->conn->real_escape_string($data['note'] ?? '');

        $sql = "INSERT INTO exam_result_details
                (result_id, question_number, student_answer, correct_answer, is_correct, confidence, note)
                VALUES
                ($resultId, $questionNumber, '$studentAnswer', '$correctAnswer', $isCorrect, $confidence, '$note')";

        return $this->conn->query($sql);
    }

    public function getByResult($resultId)
    {
        $resultId = (int)$resultId;
        $sql = "SELECT * FROM exam_result_details WHERE result_id = $resultId ORDER BY question_number ASC";
        $result = $this->conn->query($sql);

        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }

        return $items;
    }

    public function deleteByResult($resultId)
    {
        $resultId = (int)$resultId;
        return $this->conn->query("DELETE FROM exam_result_details WHERE result_id = $resultId");
    }

    public function replaceForResult($resultId, $details)
    {
        $this->deleteByResult($resultId);

        foreach ($details as $detail) {
            $detail['result_id'] = $resultId;
            $this->create($detail);
        }

        return true;
    }
}
