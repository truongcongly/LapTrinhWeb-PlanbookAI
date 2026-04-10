<?php

namespace App\Models;

use App\Core\Database;

class Question
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllByTeacher($teacherId)
    {
        $teacherId = (int)$teacherId;
        $sql = "SELECT * FROM questions WHERE teacher_id = $teacherId ORDER BY id DESC";
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
        $sql = "SELECT * FROM questions WHERE id = $id LIMIT 1";
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function create($data)
    {
        $teacherId = (int)$data['teacher_id'];
        $questionText = $this->conn->real_escape_string($data['question_text']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $topic = $this->conn->real_escape_string($data['topic']);
        $difficulty = $this->conn->real_escape_string($data['difficulty']);
        $optionA = $this->conn->real_escape_string($data['option_a']);
        $optionB = $this->conn->real_escape_string($data['option_b']);
        $optionC = $this->conn->real_escape_string($data['option_c']);
        $optionD = $this->conn->real_escape_string($data['option_d']);
        $correctAnswer = $this->conn->real_escape_string($data['correct_answer']);

        $sql = "INSERT INTO questions
                (teacher_id, question_text, subject, topic, difficulty, option_a, option_b, option_c, option_d, correct_answer)
                VALUES
                ($teacherId, '$questionText', '$subject', '$topic', '$difficulty', '$optionA', '$optionB', '$optionC', '$optionD', '$correctAnswer')";

        return $this->conn->query($sql);
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $questionText = $this->conn->real_escape_string($data['question_text']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $topic = $this->conn->real_escape_string($data['topic']);
        $difficulty = $this->conn->real_escape_string($data['difficulty']);
        $optionA = $this->conn->real_escape_string($data['option_a']);
        $optionB = $this->conn->real_escape_string($data['option_b']);
        $optionC = $this->conn->real_escape_string($data['option_c']);
        $optionD = $this->conn->real_escape_string($data['option_d']);
        $correctAnswer = $this->conn->real_escape_string($data['correct_answer']);

        $sql = "UPDATE questions SET
                question_text = '$questionText',
                subject = '$subject',
                topic = '$topic',
                difficulty = '$difficulty',
                option_a = '$optionA',
                option_b = '$optionB',
                option_c = '$optionC',
                option_d = '$optionD',
                correct_answer = '$correctAnswer'
                WHERE id = $id";

        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM questions WHERE id = $id";
        return $this->conn->query($sql);
    }
}