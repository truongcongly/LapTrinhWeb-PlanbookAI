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

    public function getAll($filters = [])
    {
        $where = [];

        if (!empty($filters['subject'])) {
            $subject = $this->conn->real_escape_string($filters['subject']);
            $where[] = "subject = '$subject'";
        }

        if (!empty($filters['grade_level'])) {
            $grade = $this->conn->real_escape_string($filters['grade_level']);
            $where[] = "grade_level = '$grade'";
        }

        if (!empty($filters['status'])) {
            $status = $this->conn->real_escape_string($filters['status']);
            $where[] = "status = '$status'";
        }

        $sql = "SELECT * FROM lesson_plan_samples";
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }
        $sql .= " ORDER BY id DESC";

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
        $staffId     = (int)$data['staff_id'];
        $title       = $this->conn->real_escape_string($data['title']);
        $subject     = $this->conn->real_escape_string($data['subject']);
        $gradeLevel  = $this->conn->real_escape_string($data['grade_level']);
        $objectives  = $this->conn->real_escape_string($data['objectives']);
        $activities  = $this->conn->real_escape_string($data['activities']);
        $assessment  = $this->conn->real_escape_string($data['assessment']);
        $status      = $this->conn->real_escape_string($data['status']);

        $sql = "INSERT INTO lesson_plan_samples
                (staff_id, title, subject, grade_level, objectives, activities, assessment, status)
                VALUES
                ($staffId, '$title', '$subject', '$gradeLevel', '$objectives', '$activities', '$assessment', '$status')";

        return $this->conn->query($sql);
    }

    public function update($id, $data)
    {
        $id          = (int)$id;
        $title       = $this->conn->real_escape_string($data['title']);
        $subject     = $this->conn->real_escape_string($data['subject']);
        $gradeLevel  = $this->conn->real_escape_string($data['grade_level']);
        $objectives  = $this->conn->real_escape_string($data['objectives']);
        $activities  = $this->conn->real_escape_string($data['activities']);
        $assessment  = $this->conn->real_escape_string($data['assessment']);
        $status      = $this->conn->real_escape_string($data['status']);

        $sql = "UPDATE lesson_plan_samples SET
                title       = '$title',
                subject     = '$subject',
                grade_level = '$gradeLevel',
                objectives  = '$objectives',
                activities  = '$activities',
                assessment  = '$assessment',
                status      = '$status'
                WHERE id = $id";

        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM lesson_plan_samples WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function getDistinctSubjects()
    {
        $sql = "SELECT DISTINCT subject FROM lesson_plan_samples ORDER BY subject ASC";
        $result = $this->conn->query($sql);
        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row['subject'];
            }
        }
        return $items;
    }

    public function getDistinctGradeLevels($subject = null)
    {
        $sql = "SELECT DISTINCT grade_level FROM lesson_plan_samples";
        if ($subject !== null && trim($subject) !== '') {
            $subject = $this->conn->real_escape_string($subject);
            $sql .= " WHERE subject = '$subject'";
        }
        $sql .= " ORDER BY grade_level ASC";
        $result = $this->conn->query($sql);
        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row['grade_level'];
            }
        }
        return $items;
    }
}