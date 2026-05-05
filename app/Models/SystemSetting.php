<?php

namespace App\Models;

use App\Core\Database;

class SystemSetting
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllAssoc()
    {
        $result = $this->conn->query("SELECT * FROM system_settings");
        $settings = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        }

        return $settings;
    }

    public function updateValue($key, $value)
    {
        $key = $this->conn->real_escape_string($key);
        $value = $this->conn->real_escape_string($value);

        $exists = $this->conn->query("SELECT id FROM system_settings WHERE setting_key = '$key' LIMIT 1");
        if ($exists && $exists->num_rows > 0) {
            return $this->conn->query("UPDATE system_settings SET setting_value = '$value' WHERE setting_key = '$key'");
        }

        return $this->conn->query("INSERT INTO system_settings (setting_key, setting_value) VALUES ('$key', '$value')");
    }
}
