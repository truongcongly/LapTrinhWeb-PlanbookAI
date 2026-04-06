<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class CurriculumFramework {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        return $this->db->query("SELECT * FROM curriculum_frameworks")
                        ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO curriculum_frameworks(title, description, created_by)
             VALUES (?, ?, ?)"
        );
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['created_by']
        ]);
    }
}