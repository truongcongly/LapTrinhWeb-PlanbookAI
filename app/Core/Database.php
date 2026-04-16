<?php

namespace App\Core;

use mysqli;

class Database
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {

            $config = require __DIR__ . '/../../config/database.php';

            if (!is_array($config)) {
                die("DB config lỗi: không phải array");
            }

            self::$instance = new mysqli(
                $config['host'],
                $config['username'],
                $config['password'],
                $config['dbname']
            );

            if (self::$instance->connect_error) {
                die("DB connect failed: " . self::$instance->connect_error);
            }
        }

        return self::$instance;
    }
}