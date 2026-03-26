<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function findByEmail($email)
    {
        $email = $this->conn->real_escape_string($email);
        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $result = $this->conn->query($sql);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }

    public function findById($id)
    {
        $id = (int) $id;
        $sql = "SELECT * FROM users WHERE id = $id LIMIT 1";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    public function create($data)
    {
        $name = $this->conn->real_escape_string($data['name']);
        $email = $this->conn->real_escape_string($data['email']);
        $password = md5($data['password']);
        $role = $this->conn->real_escape_string($data['role']);

        $sql = "INSERT INTO users (name, email, password, role)
                VALUES ('$name', '$email', '$password', '$role')";

        return $this->conn->query($sql);
    }

    public function update($id, $data)
    {
        $id = (int) $id;
        $name = $this->conn->real_escape_string($data['name']);
        $email = $this->conn->real_escape_string($data['email']);
        $role = $this->conn->real_escape_string($data['role']);

        $sql = "UPDATE users
                SET name='$name', email='$email', role='$role'
                WHERE id=$id";

        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $id = (int) $id;
        $sql = "DELETE FROM users WHERE id = $id";
        return $this->conn->query($sql);
    }
}