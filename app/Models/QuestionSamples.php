<?php

namespace App\Models;
use App\Core\Database;

use mysqli;
use mysqli_sql_exception;

class QuestionSamples
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Lấy tất cả
    public function getAll()
    {
        $sql = "SELECT * FROM question_samples ORDER BY id DESC";
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Lấy theo ID
    public function findById($id)
    {
        $id = (int)$id;
        $sql = "SELECT * FROM question_samples WHERE id = $id LIMIT 1";

        try {
            $result = $this->conn->query($sql);
            return $result ? $result->fetch_assoc() : null;
        } catch (mysqli_sql_exception $e) {
            return null;
        }
    }

    // Tạo mới
    public function create($data)
    {
        $staff_id       = (int)($data['staff_id'] ?? 0);
        $question_text = $this->conn->real_escape_string($data['question_text']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $topic = $this->conn->real_escape_string($data['topic']);
        $difficulty = $this->conn->real_escape_string($data['difficulty']);
        $option_a = $this->conn->real_escape_string($data['option_a']);
        $option_b = $this->conn->real_escape_string($data['option_b']);
        $option_c = $this->conn->real_escape_string($data['option_c']);
        $option_d = $this->conn->real_escape_string($data['option_d']);
        $correct_answer = $this->conn->real_escape_string($data['correct_answer']);
        $status         = $this->conn->real_escape_string($data['status'] ?? 'draft');

        $sql = "INSERT INTO question_samples 
        (staff_id, question_text, subject, topic, difficulty, option_a, option_b, option_c, option_d, correct_answer, status)
        VALUES 
        ($staff_id, '$question_text', '$subject', '$topic', '$difficulty', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_answer', '$status')";

        return $this->conn->query($sql);
    }

    // Update
    public function update($id, $data)
    {
        $id = (int)$id;

        $question_text = $this->conn->real_escape_string($data['question_text']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $topic = $this->conn->real_escape_string($data['topic']);
        $difficulty = $this->conn->real_escape_string($data['difficulty']);
        $option_a = $this->conn->real_escape_string($data['option_a']);
        $option_b = $this->conn->real_escape_string($data['option_b']);
        $option_c = $this->conn->real_escape_string($data['option_c']);
        $option_d = $this->conn->real_escape_string($data['option_d']);
        $correct_answer = $this->conn->real_escape_string($data['correct_answer']);

        $sql = "UPDATE question_samples SET
            question_text = '$question_text',
            subject = '$subject',
            topic = '$topic',
            difficulty = '$difficulty',
            option_a = '$option_a',
            option_b = '$option_b',
            option_c = '$option_c',
            option_d = '$option_d',
            correct_answer = '$correct_answer'
        WHERE id = $id";

        return $this->conn->query($sql);
    }

    // Delete
    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM question_samples WHERE id = $id";
        return $this->conn->query($sql);
    }
}