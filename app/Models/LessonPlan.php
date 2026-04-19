<?php

namespace App\Models;

use App\Core\Database;

class LessonPlan
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllByTeacher($teacherId)
    {
        $teacherId = (int)$teacherId;
        $sql = "SELECT * FROM lesson_plans WHERE teacher_id = $teacherId ORDER BY id DESC";
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
        $sql = "SELECT * FROM lesson_plans WHERE id = $id LIMIT 1";
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function create($data)
    {
        $teacherId = (int)$data['teacher_id'];
        $title = $this->conn->real_escape_string($data['title']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $gradeLevel = $this->conn->real_escape_string($data['grade_level']);
        $topic = $this->conn->real_escape_string($data['topic'] ?? '');
        $objectives = $this->conn->real_escape_string($data['objectives']);
        $activities = $this->conn->real_escape_string($data['activities']);
        $assessment = $this->conn->real_escape_string($data['assessment']);
        $status = $this->conn->real_escape_string($data['status'] ?? 'draft');

        $sql = "INSERT INTO lesson_plans
                (teacher_id, title, subject, grade_level, topic, objectives, activities, assessment, status)
                VALUES
                ($teacherId, '$title', '$subject', '$gradeLevel', '$topic', '$objectives', '$activities', '$assessment', '$status')";

        if (!$this->conn->query($sql)) {
            die('LessonPlan::create SQL ERROR: ' . $this->conn->error . '<br>SQL: ' . $sql);
        }

        return true;
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $title = $this->conn->real_escape_string($data['title']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $gradeLevel = $this->conn->real_escape_string($data['grade_level']);
        $topic = $this->conn->real_escape_string($data['topic'] ?? '');
        $objectives = $this->conn->real_escape_string($data['objectives']);
        $activities = $this->conn->real_escape_string($data['activities']);
        $assessment = $this->conn->real_escape_string($data['assessment']);
        $status = $this->conn->real_escape_string($data['status'] ?? 'draft');

        $sql = "UPDATE lesson_plans SET
                title = '$title',
                subject = '$subject',
                grade_level = '$gradeLevel',
                topic = '$topic',
                objectives = '$objectives',
                activities = '$activities',
                assessment = '$assessment',
                status = '$status'
                WHERE id = $id";

        if (!$this->conn->query($sql)) {
            die('LessonPlan::update SQL ERROR: ' . $this->conn->error . '<br>SQL: ' . $sql);
        }

        return true;
    }

    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM lesson_plans WHERE id = $id";
        return $this->conn->query($sql);
    }
}