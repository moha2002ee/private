<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'private';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host, $this->username, $this->password);
            $this->conn->exec("set names utf8");

            // Create database if it doesn't exist
            $this->conn->exec("CREATE DATABASE IF NOT EXISTS " . $this->db_name);
            $this->conn->exec("USE " . $this->db_name);

            // Create tables if they don't exist
            $this->createUsersTable();
            $this->updateUsersTable(); // Ensure the profile_image column exists
            $this->createProfTable();
            $this->createMatiereTable();
            $this->createSynthesesTable();
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    private function createUsersTable() {
        $query = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            profile_image VARCHAR(255) DEFAULT NULL
        )";
        $this->conn->exec($query);
    }

    private function updateUsersTable() {
        // Check if the column exists
        $query = "SHOW COLUMNS FROM users LIKE 'profile_image'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            // Add the column if it does not exist
            $query = "ALTER TABLE users ADD COLUMN profile_image VARCHAR(255) DEFAULT NULL";
            $this->conn->exec($query);
        }
    }

    private function createProfTable() {
        $query = "CREATE TABLE IF NOT EXISTS prof (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        )";
        $this->conn->exec($query);
    }

    private function createMatiereTable() {
        $query = "CREATE TABLE IF NOT EXISTS matiere (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        )";
        $this->conn->exec($query);
    }

    private function createSynthesesTable() {
        $query = "CREATE TABLE IF NOT EXISTS syntheses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            file_path VARCHAR(255) NOT NULL,
            prof_id INT,
            matiere_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (prof_id) REFERENCES prof(id),
            FOREIGN KEY (matiere_id) REFERENCES matiere(id)
        )";
        $this->conn->exec($query);
    }
}
?>