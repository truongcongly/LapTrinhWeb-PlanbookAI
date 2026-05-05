<?php

namespace App\Models;

use App\Core\Database;

class Question
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->ensureQuestionsTable();
    }

    private function ensureQuestionsTable(): void
    {
        try {
            $result = $this->conn->query("SHOW TABLES LIKE 'questions'");
            if ($result && $result->num_rows > 0) {
                return;
            }

            $sql = "CREATE TABLE IF NOT EXISTS questions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                teacher_id INT NOT NULL,
                question_text TEXT NOT NULL,
                subject VARCHAR(100) NOT NULL,
                topic VARCHAR(100) NOT NULL,
                difficulty ENUM('easy', 'medium', 'hard') DEFAULT 'medium',
                option_a VARCHAR(255) DEFAULT NULL,
                option_b VARCHAR(255) DEFAULT NULL,
                option_c VARCHAR(255) DEFAULT NULL,
                option_d VARCHAR(255) DEFAULT NULL,
                correct_answer ENUM('A', 'B', 'C', 'D') DEFAULT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";

            $this->conn->query($sql);
        } catch (\mysqli_sql_exception $e) {
            // If schema creation fails, allow app to continue; callers handle empty results.
        }
    }

    public function getAllByTeacher($teacherId)
    {
        $teacherId = (int)$teacherId;
        $sql = "SELECT * FROM questions WHERE teacher_id = $teacherId ORDER BY id DESC";

        try {
            $result = $this->conn->query($sql);
        } catch (\mysqli_sql_exception $e) {
            return [];
        }

        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }

        return $items;
    }

    public function getAllByTeacherFiltered($teacherId, $filters = [])
    {
        $teacherId = (int)$teacherId;

        $subject = trim($filters['subject'] ?? '');
        $topic = trim($filters['topic'] ?? '');
        $difficulty = trim($filters['difficulty'] ?? '');

        $conditions = ["teacher_id = $teacherId"];

        if ($subject !== '') {
            $subjectEsc = $this->conn->real_escape_string($subject);
            $conditions[] = "subject = '$subjectEsc'";
        }

        if ($topic !== '') {
            $topicEsc = $this->conn->real_escape_string($topic);
            $conditions[] = "topic = '$topicEsc'";
        }

        if ($difficulty !== '' && in_array($difficulty, ['easy', 'medium', 'hard'], true)) {
            $difficultyEsc = $this->conn->real_escape_string($difficulty);
            $conditions[] = "difficulty = '$difficultyEsc'";
        }

        $where = implode(' AND ', $conditions);
        $sql = "SELECT * FROM questions WHERE $where ORDER BY id DESC";
        try {
            $result = $this->conn->query($sql);
        } catch (\mysqli_sql_exception $e) {
            return [];
        }

        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }

        return $items;
    }

    public function getDistinctSubjectsByTeacher($teacherId)
    {
        $teacherId = (int)$teacherId;
        $sql = "SELECT DISTINCT subject FROM questions WHERE teacher_id = $teacherId AND subject <> '' ORDER BY subject ASC";
        try {
            $result = $this->conn->query($sql);
        } catch (\mysqli_sql_exception $e) {
            return [];
        }

        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                if (isset($row['subject'])) {
                    $items[] = $row['subject'];
                }
            }
        }

        return $items;
    }

    public function getDistinctTopicsByTeacher($teacherId, $subject = null)
    {
        $teacherId = (int)$teacherId;
        $conditions = ["teacher_id = $teacherId", "topic <> ''"];

        if ($subject !== null && trim($subject) !== '') {
            $subjectEsc = $this->conn->real_escape_string(trim($subject));
            $conditions[] = "subject = '$subjectEsc'";
        }

        $where = implode(' AND ', $conditions);
        $sql = "SELECT DISTINCT topic FROM questions WHERE $where ORDER BY topic ASC";
        try {
            $result = $this->conn->query($sql);
        } catch (\mysqli_sql_exception $e) {
            return [];
        }

        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                if (isset($row['topic'])) {
                    $items[] = $row['topic'];
                }
            }
        }

        return $items;
    }

    public function findById($id)
    {
        $id = (int)$id;
        $sql = "SELECT * FROM questions WHERE id = $id LIMIT 1";
        try {
            $result = $this->conn->query($sql);
            return $result ? $result->fetch_assoc() : null;
        } catch (\mysqli_sql_exception $e) {
            return null;
        }
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

        try {
            return $this->conn->query($sql);
        } catch (\mysqli_sql_exception $e) {
            return false;
        }
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

        try {
            return $this->conn->query($sql);
        } catch (\mysqli_sql_exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM questions WHERE id = $id";
        try {
            return $this->conn->query($sql);
        } catch (\mysqli_sql_exception $e) {
            return false;
        }
    }

    public function getAllByTeacherSimple($teacherId)
    {
        return $this->getAllByTeacher($teacherId);
    }

    public function findManyByIds($ids)
    {
        $ids = array_map('intval', $ids);
            if (empty($ids)) {
            return [];
        }

        $idList = implode(',', $ids);
        $sql = "SELECT * FROM questions WHERE id IN ($idList) ORDER BY FIELD(id, $idList)";
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
