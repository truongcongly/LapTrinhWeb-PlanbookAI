<?php
namespace App\Models;

use App\Core\Database;

class PromptTemplate
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllByStaff($staffId)
    {
        $staffId = (int)$staffId;
        $sql = "SELECT * FROM prompt_templates WHERE staff_id = $staffId ORDER BY id DESC";
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
        $sql = "SELECT * FROM prompt_templates WHERE id = $id LIMIT 1";
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function create($data)
    {
        $staffId = (int)$data['staff_id'];
        $title = $this->conn->real_escape_string($data['title']);
        $category = $this->conn->real_escape_string($data['category']);
        $promptContent = $this->conn->real_escape_string($data['prompt_content']);
        $description = $this->conn->real_escape_string($data['description']);
        $status = $this->conn->real_escape_string($data['status']);

        $sql = "INSERT INTO prompt_templates
                (staff_id, title, category, prompt_content, description, status)
                VALUES
                ($staffId, '$title', '$category', '$promptContent', '$description', '$status')";

        return $this->conn->query($sql);
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $title = $this->conn->real_escape_string($data['title']);
        $category = $this->conn->real_escape_string($data['category']);
        $promptContent = $this->conn->real_escape_string($data['prompt_content']);
        $description = $this->conn->real_escape_string($data['description']);
        $status = $this->conn->real_escape_string($data['status']);

        $sql = "UPDATE prompt_templates SET
                title = '$title',
                category = '$category',
                prompt_content = '$promptContent',
                description = '$description',
                status = '$status'
                WHERE id = $id";

        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        return $this->conn->query("DELETE FROM prompt_templates WHERE id = $id");
    }
}