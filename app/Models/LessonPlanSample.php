<?php

namespace App\Models;

use App\Core\Database;

class LessonPlanSample
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllByStaff($staffId)
    {
        $staffId = (int)$staffId;
        $sql = "SELECT * FROM lesson_plan_samples WHERE staff_id = $staffId ORDER BY id DESC";
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
        $sql = "SELECT * FROM lesson_plan_samples WHERE id = $id LIMIT 1";
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function create($data)
    {
        $staffId = (int)$data['staff_id'];
        $title = $this->conn->real_escape_string($data['title']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $gradeLevel = $this->conn->real_escape_string($data['grade_level']);
        $topic = $this->conn->real_escape_string($data['topic']);
        $objectives = $this->conn->real_escape_string($data['objectives']);
        $activities = $this->conn->real_escape_string($data['activities']);
        $assessment = $this->conn->real_escape_string($data['assessment']);
        $status = $this->conn->real_escape_string($data['status'] ?? 'draft');

        $sql = "INSERT INTO lesson_plan_samples
            (staff_id, title, subject, grade_level, topic, objectives, activities, assessment, status)
            VALUES
            ($staffId, '$title', '$subject', '$gradeLevel', '$topic', '$objectives', '$activities', '$assessment', '$status')";

        return $this->conn->query($sql);
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $title = $this->conn->real_escape_string($data['title']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $gradeLevel = $this->conn->real_escape_string($data['grade_level']);
        $topic = $this->conn->real_escape_string($data['topic']);
        $objectives = $this->conn->real_escape_string($data['objectives']);
        $activities = $this->conn->real_escape_string($data['activities']);
        $assessment = $this->conn->real_escape_string($data['assessment']);
        $status = $this->conn->real_escape_string($data['status'] ?? 'draft');

        $sql = "UPDATE lesson_plan_samples SET
            title = '$title',
            subject = '$subject',
            grade_level = '$gradeLevel',
            topic = '$topic',
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
        return $this->conn->query("DELETE FROM lesson_plan_samples WHERE id = $id");
    }

    public function getAllApproved()
    {
        $sql = "SELECT * FROM lesson_plan_samples WHERE status = 'approved' ORDER BY id DESC";
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