<?php

namespace App\Models;

use App\Core\Database;

class Exam
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllByTeacher($teacherId)
    {
        $teacherId = (int)$teacherId;

        $sql = "SELECT e.*, k.answer_key
                FROM exams e
                LEFT JOIN exam_answer_keys k ON e.id = k.exam_id
                WHERE e.teacher_id = $teacherId
                ORDER BY e.id DESC";

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

        $sql = "SELECT e.*, k.answer_key
                FROM exams e
                LEFT JOIN exam_answer_keys k ON e.id = k.exam_id
                WHERE e.id = $id
                LIMIT 1";

        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function create($data)
    {
        $teacherId = (int)$data['teacher_id'];
        $title = $this->conn->real_escape_string($data['title']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $gradeLevel = $this->conn->real_escape_string($data['grade_level']);
        $totalQuestions = (int)$data['total_questions'];
        $durationMinutes = (int)$data['duration_minutes'];
        $status = $this->conn->real_escape_string($data['status']);
        $instructions = $this->conn->real_escape_string($data['instructions']);

        $sql = "INSERT INTO exams
                (teacher_id, title, subject, grade_level, total_questions, duration_minutes, status, instructions)
                VALUES
                ($teacherId, '$title', '$subject', '$gradeLevel', $totalQuestions, $durationMinutes, '$status', '$instructions')";

        $this->conn->query($sql);

        return $this->conn->insert_id;
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $title = $this->conn->real_escape_string($data['title']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $gradeLevel = $this->conn->real_escape_string($data['grade_level']);
        $totalQuestions = (int)$data['total_questions'];
        $durationMinutes = (int)$data['duration_minutes'];
        $status = $this->conn->real_escape_string($data['status']);
        $instructions = $this->conn->real_escape_string($data['instructions']);

        $sql = "UPDATE exams SET
                title = '$title',
                subject = '$subject',
                grade_level = '$gradeLevel',
                total_questions = $totalQuestions,
                duration_minutes = $durationMinutes,
                status = '$status',
                instructions = '$instructions'
                WHERE id = $id";

        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;

        $this->conn->query("DELETE FROM exam_answer_keys WHERE exam_id = $id");
        return $this->conn->query("DELETE FROM exams WHERE id = $id");
    }

    public function saveAnswerKey($examId, $answerKey)
    {
        $examId = (int)$examId;
        $answerKey = $this->conn->real_escape_string($answerKey);

        $check = $this->conn->query("SELECT id FROM exam_answer_keys WHERE exam_id = $examId LIMIT 1");

        if ($check && $check->num_rows > 0) {
            return $this->conn->query("UPDATE exam_answer_keys SET answer_key = '$answerKey' WHERE exam_id = $examId");
        }

        return $this->conn->query("INSERT INTO exam_answer_keys (exam_id, answer_key) VALUES ($examId, '$answerKey')");
    }

    public function getAllSimpleByTeacher($teacherId)
    {
        $teacherId = (int)$teacherId;
        $sql = "SELECT * FROM exams WHERE teacher_id = $teacherId ORDER BY id DESC";
        $result = $this->conn->query($sql);

        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }

        return $items;
    }

    public function findSimpleById($id)
    {
        $id = (int)$id;
        $sql = "SELECT * FROM exams WHERE id = $id LIMIT 1";
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }
}