<?php
include_once 'config/database.php';

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;
    public $profile_image;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTableName() {
        return $this->table_name;
    }

    public function login() {
        $query = "SELECT id, username, password, profile_image FROM " . $this->getTableName() . " WHERE username = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            if(password_verify($this->password, $row['password'])) {
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->profile_image = $row['profile_image'];
                return true;
            }
        }
        return false;
    }

    public function register() {
        // Check if username already exists
        $query = "SELECT id FROM " . $this->table_name . " WHERE username = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->username);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            // Username already exists
            return false;
        }

        // Insert new user
        $query = "INSERT INTO " . $this->table_name . " (username, password, profile_image) VALUES (:username, :password, :profile_image)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':profile_image', $this->profile_image);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>