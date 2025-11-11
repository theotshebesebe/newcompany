<?php
// filepath: /newcompany/newcompany/app/models/Post.php

class Post {
    private $db;

    public function __construct() {
        // Initialize the database connection
        $this->db = new Database();
    }

    // Create a new post
    public function create($data) {
        $this->db->query("INSERT INTO posts (title, body, user_id) VALUES (:title, :body, :user_id)");
        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':user_id', $data['user_id']);
        
        // Execute the query
        if($this->db->execute()) {
            return true;
        }
        return false;
    }

    // Create a new post (alias for create method)
    public function addPost($data) {
        return $this->create($data);
    }

    // Get all posts for a specific user, including the user's name
    public function getPostsByUser($user_id) {
        $this->db->query("SELECT posts.*, users.name FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        
        $results = $this->db->resultSet();
        return $results;
    }

    // Get a single post by ID, including the user's name
    public function getPostById($id) {
        $this->db->query("SELECT posts.*, users.name FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = :id");
        $this->db->bind(':id', $id);
        
        $row = $this->db->single();
        return $row;
    }

    // Update a post
    public function update($id, $data) {
        $this->db->query("UPDATE posts SET title = :title, body = :body WHERE id = :id");
        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':id', $id);
        
        // Execute the query
        if($this->db->execute()) {
            return true;
        }
        return false;
    }

    // Update a post (alias for update method)
    public function updatePost($data) {
        return $this->update($data['id'], $data);
    }

    // Delete a post
    public function delete($id) {
        $this->db->query("DELETE FROM posts WHERE id = :id");
        // Bind value
        $this->db->bind(':id', $id);
        
        // Execute the query
        if($this->db->execute()) {
            return true;
        }
        return false;
    }

    // Delete a post (alias for delete method)
    public function deletePost($id) {
        return $this->delete($id);
    }
}
?>