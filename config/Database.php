<?php

class Database {
    private string $host;
    private string $database;
    private string $username;
    private string $password;

    public function __construct() {
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->database = getenv('DB_NAME') ?: 'task_manager';
        $this->username = getenv('DB_USER') ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: '';
    }

    public function connect(): PDO {

        $connString = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";

        $pdo = new PDO(
            $connString,
            $this->username,
            $this->password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );

        return $pdo;
    }
}