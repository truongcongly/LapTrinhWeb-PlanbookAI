<?php

namespace App\Models;

use App\Core\Database;

class ExerciseQuestion
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->ensureTable();
    }

    private function ensureTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS exercise_questions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            exercise_id INT NOT NULL,
            question_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        $this->conn->query($sql);
    }

    public function create($exerciseId, $questionId)
    {
        $exerciseId = (int)$exerciseId;
        $questionId = (int)$questionId;

        return $this->conn->query("INSERT INTO exercise_questions (exercise_id, question_id) VALUES ($exerciseId, $questionId)");
    }

    public function deleteByExerciseId($exerciseId)
    {
        $exerciseId = (int)$exerciseId;
        return $this->conn->query("DELETE FROM exercise_questions WHERE exercise_id = $exerciseId");
    }

    public function getQuestionIdsByExercise($exerciseId)
    {
        $exerciseId = (int)$exerciseId;
        $result = $this->conn->query("SELECT question_id FROM exercise_questions WHERE exercise_id = $exerciseId");

        $ids = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $ids[] = (int)$row['question_id'];
            }
        }

        return $ids;
    }

    public function getQuestionsByExercise($exerciseId)
    {
        $exerciseId = (int)$exerciseId;

        $sql = "SELECT q.*
                FROM exercise_questions eq
                INNER JOIN questions q ON eq.question_id = q.id
                WHERE eq.exercise_id = $exerciseId
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
