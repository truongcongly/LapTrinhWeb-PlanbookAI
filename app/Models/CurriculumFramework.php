<?php

namespace App\Models;

use App\Core\Database;

class CurriculumFramework
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM curriculum_frameworks ORDER BY id DESC";
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
        $sql = "SELECT * FROM curriculum_frameworks WHERE id = $id LIMIT 1";
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function create($data)
    {
        $adminId = (int)$data['admin_id'];
        $title = $this->conn->real_escape_string($data['title']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $gradeLevel = $this->conn->real_escape_string($data['grade_level']);
        $objectives = $this->conn->real_escape_string($data['objectives']);
        $activities = $this->conn->real_escape_string($data['activities']);
        $assessment = $this->conn->real_escape_string($data['assessment']);
        $status = $this->conn->real_escape_string($data['status']);

        $sql = "INSERT INTO curriculum_frameworks
                (admin_id, title, subject, grade_level, objectives, activities, assessment, status)
                VALUES
                ($adminId, '$title', '$subject', '$gradeLevel', '$objectives', '$activities', '$assessment', '$status')";

        return $this->conn->query($sql);
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $title = $this->conn->real_escape_string($data['title']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $gradeLevel = $this->conn->real_escape_string($data['grade_level']);
        $objectives = $this->conn->real_escape_string($data['objectives']);
        $activities = $this->conn->real_escape_string($data['activities']);
        $assessment = $this->conn->real_escape_string($data['assessment']);
        $status = $this->conn->real_escape_string($data['status']);

        $sql = "UPDATE curriculum_frameworks SET
                title = '$title',
                subject = '$subject',
                grade_level = '$gradeLevel',
                objectives = '$objectives',
                activities = '$activities',
                assessment = '$assessment',
                status = '$status'
                WHERE id = $id";

        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        return $this->conn->query("DELETE FROM curriculum_frameworks WHERE id = $id");
    }

    public function countAll()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS total FROM curriculum_frameworks");
        $row = $result->fetch_assoc();
        return (int)$row['total'];
    }
}