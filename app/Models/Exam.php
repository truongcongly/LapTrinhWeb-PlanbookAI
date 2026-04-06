<?php

namespace App\Models;

use App\Core\Database;

class Exam
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM exams WHERE created_by = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM exams WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO exams (title, subject, duration_minutes, total_questions, created_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiii", $data['title'], $data['subject'], $data['duration_minutes'], $data['total_questions'], $data['created_by']);
        $stmt->execute();
        return $this->db->insert_id;
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM exams WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}