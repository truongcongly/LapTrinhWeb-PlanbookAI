<?php

namespace App\Models;

use App\Core\Database;

class ExamResult
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllByTeacher($teacherId)
    {
        $teacherId = (int)$teacherId;

        $sql = "SELECT r.*, e.title AS exam_title
                FROM exam_results r
                LEFT JOIN exams e ON r.exam_id = e.id
                WHERE r.teacher_id = $teacherId
                ORDER BY r.id DESC";

        $result = $this->conn->query($sql);

        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }

        return $items;
    }

    public function findById($id)
    {
        $id = (int)$id;

        $sql = "SELECT r.*, e.title AS exam_title, e.subject, e.grade_level
                FROM exam_results r
                LEFT JOIN exams e ON r.exam_id = e.id
                WHERE r.id = $id
                LIMIT 1";

        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function create($data)
    {
        $examId = (int)$data['exam_id'];
        $teacherId = (int)$data['teacher_id'];
        $studentName = $this->conn->real_escape_string($data['student_name']);
        $scannedAnswers = $this->conn->real_escape_string($data['scanned_answers'] ?? '');
        $submittedAnswers = $this->conn->real_escape_string($data['submitted_answers'] ?? '');
        $totalQuestions = (int)$data['total_questions'];
        $correctCount = (int)$data['correct_count'];
        $score = (float)$data['score'];
        $feedback = $this->conn->real_escape_string($data['feedback'] ?? '');
        $status = $this->conn->real_escape_string($data['status'] ?? 'auto_graded');

        $sql = "INSERT INTO exam_results
                (exam_id, teacher_id, student_name, scanned_answers, submitted_answers, total_questions, correct_count, score, feedback, status)
                VALUES
                ($examId, $teacherId, '$studentName', '$scannedAnswers', '$submittedAnswers', $totalQuestions, $correctCount, $score, '$feedback', '$status')";

        return $this->conn->query($sql);
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $studentName = $this->conn->real_escape_string($data['student_name']);
        $feedback = $this->conn->real_escape_string($data['feedback']);
        $score = (float)$data['score'];
        $status = $this->conn->real_escape_string($data['status']);

        $sql = "UPDATE exam_results SET
                student_name = '$studentName',
                feedback = '$feedback',
                score = $score,
                status = '$status'
                WHERE id = $id";

        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        return $this->conn->query("DELETE FROM exam_results WHERE id = $id");
    }
}