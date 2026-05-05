<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private $conn;
    private ?bool $hasServicePlanColumn = null;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function findByEmail($email)
    {
        $email = $this->conn->real_escape_string($email);
        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function findByEmailExceptId($email, $id)
    {
        $email = $this->conn->real_escape_string($email);
        $id = (int) $id;

        $sql = "SELECT * FROM users WHERE email = '$email' AND id != $id LIMIT 1";
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $result = $this->conn->query($sql);

        $users = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $this->mapUserRow($row);
            }
        }

        return $users;
    }

    public function search($keyword = '', $role = '')
    {
        $conditions = [];

        if ($keyword !== '') {
            $keyword = $this->conn->real_escape_string($keyword);
            $conditions[] = "(name LIKE '%$keyword%' OR email LIKE '%$keyword%')";
        }

        if ($role !== '') {
            $role = $this->conn->real_escape_string($role);
            $conditions[] = "role = '$role'";
        }

        $where = '';
        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', $conditions);
        }

        $sql = "SELECT * FROM users $where ORDER BY id DESC";
        $result = $this->conn->query($sql);

        $users = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $this->mapUserRow($row);
            }
        }

        return $users;
    }

    public function findById($id)
    {
        $id = (int) $id;
        $sql = "SELECT * FROM users WHERE id = $id LIMIT 1";
        $result = $this->conn->query($sql);

        $user = $result ? $result->fetch_assoc() : null;
        return $user ? $this->mapUserRow($user) : null;
    }

    public function create($data)
    {
        $name = $this->conn->real_escape_string($data['name']);
        $email = $this->conn->real_escape_string($data['email']);
        $password = md5($data['password']);
        $role = $this->conn->real_escape_string($data['role']);
        $servicePlan = $this->normalizeServicePlan($data['service_plan'] ?? $this->defaultServicePlanForRole($data['role'] ?? 'teacher'));

        if ($this->hasServicePlanColumn()) {
            $servicePlan = $this->conn->real_escape_string($servicePlan);
            $sql = "INSERT INTO users (name, email, password, role, service_plan)
                    VALUES ('$name', '$email', '$password', '$role', '$servicePlan')";
        } else {
            $sql = "INSERT INTO users (name, email, password, role)
                    VALUES ('$name', '$email', '$password', '$role')";
        }

        return $this->conn->query($sql);
    }

    public function update($id, $data)
    {
        $id = (int) $id;
        $name = $this->conn->real_escape_string($data['name']);
        $email = $this->conn->real_escape_string($data['email']);
        $role = $this->conn->real_escape_string($data['role']);
        $servicePlan = $this->normalizeServicePlan($data['service_plan'] ?? $this->defaultServicePlanForRole($data['role'] ?? 'teacher'));

        if ($this->hasServicePlanColumn()) {
            $servicePlan = $this->conn->real_escape_string($servicePlan);
            $sql = "UPDATE users
                    SET name='$name', email='$email', role='$role', service_plan='$servicePlan'
                    WHERE id=$id";
        } else {
            $sql = "UPDATE users
                    SET name='$name', email='$email', role='$role'
                    WHERE id=$id";
        }

        return $this->conn->query($sql);
    }

    public function updateServicePlan($id, string $servicePlan): bool
    {
        if (!$this->hasServicePlanColumn()) {
            return false;
        }

        $id = (int) $id;
        $servicePlan = $this->conn->real_escape_string($this->normalizeServicePlan($servicePlan));

        return (bool) $this->conn->query("UPDATE users SET service_plan='$servicePlan' WHERE id=$id");
    }

    public function delete($id)
    {
        $id = (int) $id;
        $sql = "DELETE FROM users WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) as total FROM users";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return (int) $row['total'];
    }

    public function countByRole($role)
    {
        $role = $this->conn->real_escape_string($role);
        $sql = "SELECT COUNT(*) as total FROM users WHERE role = '$role'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return (int) $row['total'];
    }

    public function getRecentUsers($limit = 5)
    {
        $limit = (int) $limit;
        $sql = "SELECT id, name, email, role, created_at
                FROM users
                ORDER BY id DESC
                LIMIT $limit";

        $result = $this->conn->query($sql);

        $users = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $this->mapUserRow($row);
            }
        }

        return $users;
    }

    private function hasServicePlanColumn(): bool
    {
        if ($this->hasServicePlanColumn !== null) {
            return $this->hasServicePlanColumn;
        }

        $result = $this->conn->query("SHOW COLUMNS FROM users LIKE 'service_plan'");
        $this->hasServicePlanColumn = $result && $result->num_rows > 0;

        return $this->hasServicePlanColumn;
    }

    private function mapUserRow(array $row): array
    {
        $row['service_plan'] = $this->normalizeServicePlan(
            $row['service_plan'] ?? $this->defaultServicePlanForRole($row['role'] ?? 'teacher')
        );

        return $row;
    }

    private function normalizeServicePlan(string $servicePlan): string
    {
        return $servicePlan === 'professional' ? 'professional' : 'free';
    }

    private function defaultServicePlanForRole(string $role): string
    {
        return in_array($role, ['admin', 'staff'], true) ? 'professional' : 'free';
    }
}
