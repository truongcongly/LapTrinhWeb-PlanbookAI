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
                $items[] = $this->mapPromptRow($row);
            }
        }

        return $items;
    }

    public function getActiveTemplates($category = '')
    {
        $conditions = ["status IN ('active', 'published')"];

        if ($category !== '') {
            $category = $this->conn->real_escape_string($category);
            $conditions[] = "category = '$category'";
        }

        $where = implode(' AND ', $conditions);
        $sql = "SELECT pt.*, u.name AS staff_name
                FROM prompt_templates pt
                LEFT JOIN users u ON u.id = pt.staff_id
                WHERE $where
                ORDER BY pt.updated_at DESC, pt.id DESC";
        $result = $this->conn->query($sql);

        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $this->mapPromptRow($row);
            }
        }

        return $items;
    }

    public function findById($id)
    {
        $id = (int)$id;
        $sql = "SELECT * FROM prompt_templates WHERE id = $id LIMIT 1";
        $result = $this->conn->query($sql);

        $prompt = $result ? $result->fetch_assoc() : null;
        return $prompt ? $this->mapPromptRow($prompt) : null;
    }

    public function create($data)
    {
        $staffId = (int)$data['staff_id'];
        $title = $this->conn->real_escape_string($data['title']);
        $category = $this->conn->real_escape_string($data['category']);
        $promptContent = $this->conn->real_escape_string($data['prompt_content']);
        $description = $this->conn->real_escape_string($data['description']);
        $status = $this->conn->real_escape_string($this->normalizeStatus($data['status'] ?? 'draft'));

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
        $status = $this->conn->real_escape_string($this->normalizeStatus($data['status'] ?? 'draft'));

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

    public function importToTeacher($id)
    {
        $id = (int)$id;
        $prompt = $this->findById($id);
        if (!$prompt) {
            return false;
        }

        $category = $this->conn->real_escape_string($prompt['category'] ?? '');

        if ($category !== '') {
            $this->conn->query("UPDATE prompt_templates
                                SET status = 'archived'
                                WHERE category = '$category'
                                AND id != $id
                                AND status IN ('active', 'published')");
        }

        return $this->conn->query("UPDATE prompt_templates
                                   SET status = 'active', updated_at = CURRENT_TIMESTAMP
                                   WHERE id = $id");
    }

    private function normalizeStatus(string $status): string
    {
        if ($status === 'published') {
            return 'active';
        }

        if ($status === 'archived') {
            return 'archived';
        }

        if ($status === 'active') {
            return 'active';
        }

        return 'draft';
    }

    private function mapPromptRow(array $row): array
    {
        $row['status'] = $this->normalizeStatus($row['status'] ?? 'draft');
        return $row;
    }
}
