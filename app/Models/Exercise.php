<?php

namespace App\Models;

use App\Core\Database;

class Exercise
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllByTeacher($teacherId)
    {
        $teacherId = (int)$teacherId;
        $sql = "SELECT * FROM exercises WHERE teacher_id = $teacherId ORDER BY id DESC";
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
        $sql = "SELECT * FROM exercises WHERE id = $id LIMIT 1";
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function create($data)
    {
        $teacherId = (int)$data['teacher_id'];
        $title = $this->conn->real_escape_string($data['title']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $topic = $this->conn->real_escape_string($data['topic']);
        $description = $this->conn->real_escape_string($data['description']);
        $content = $this->conn->real_escape_string($data['content']);
        $status = $this->conn->real_escape_string($data['status']);

        $sql = "INSERT INTO exercises
                (teacher_id, title, subject, topic, description, content, status)
                VALUES
                ($teacherId, '$title', '$subject', '$topic', '$description', '$content', '$status')";

        return $this->conn->query($sql);
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $title = $this->conn->real_escape_string($data['title']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $topic = $this->conn->real_escape_string($data['topic']);
        $description = $this->conn->real_escape_string($data['description']);
        $content = $this->conn->real_escape_string($data['content']);
        $status = $this->conn->real_escape_string($data['status']);

        $sql = "UPDATE exercises SET
                title = '$title',
                subject = '$subject',
                topic = '$topic',
                description = '$description',
                content = '$content',
                status = '$status'
                WHERE id = $id";

        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM exercises WHERE id = $id";
        return $this->conn->query($sql);
    }
}