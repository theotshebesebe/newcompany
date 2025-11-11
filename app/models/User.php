<?php
// filepath: /newcompany/newcompany/app/models/User.php

class User {
    private $db;

    public function __construct() {
        // Initialize the database connection
        $this->db = new Database();
    }

    // Register a new user
    public function register($data) {
        // Prepare the SQL statement
        $this->db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

        // Bind the parameters
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        // Hash the password before storing it
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login a user
    public function login($email, $password) {
        // Prepare the SQL statement
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);

        // Get the user record
        $row = $this->db->single();

        // Check if the user exists and verify the password
        if ($row && password_verify($password, $row->password)) {
            return $row;
        } else {
            return false;
        }
    }

    // Get user by ID
    public function getUserById($id) {
        // Prepare the SQL statement
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);

        // Return the user record
        return $this->db->single();
    }

    // Check if email is already registered
    public function emailExists($email) {
        // Prepare the SQL statement
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);

        // Check if the email exists
        return $this->db->rowCount() > 0;
    }
}
?>