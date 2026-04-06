<?php

namespace App\Models;

use App\Core\Database;

class Exam
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM exams WHERE created_by = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM exams WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO exams (title, subject, duration_minutes, total_questions, created_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['title'],
            $data['subject'],
            $data['duration_minutes'],
            $data['total_questions'],
            $data['created_by']
        ]);
        return $this->db->lastInsertId();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM exams WHERE id = ?");
        return $stmt->execute([$id]);
    }
}