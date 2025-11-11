<?php

class Posts extends Controller {
    
    public function __construct() {
        // Only allow logged-in users to access posts
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }
    }

    // Display all posts from all users
    public function index() {
        try {
            require_once '../app/libraries/Database.php';
            $db = new Database();
            
            // Get all posts with author names, newest first
            $db->query("SELECT posts.*, users.name FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
            $posts = $db->resultSet();
            
            $data = [
                'posts' => $posts,
                'current_user_id' => $_SESSION['user_id'],
                'is_admin' => isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : 0
            ];
            
            $this->view('posts/index', $data);
            
        } catch (Exception $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    // Handle both showing the form and creating new posts
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form submission
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            // Validate input
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter a title';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            }

            // Save to database if validation passes
            if (empty($data['title_err']) && empty($data['body_err'])) {
                try {
                    require_once '../app/libraries/Database.php';
                    $db = new Database();
                    
                    $db->query("INSERT INTO posts (title, message, user_id, created_at) VALUES (:title, :message, :user_id, NOW())");
                    $db->bind(':title', $data['title']);
                    $db->bind(':message', $data['body']);
                    $db->bind(':user_id', $data['user_id']);
                    
                    if ($db->execute()) {
                        flash('post_message', 'Post Added Successfully');
                        redirect('posts');
                    } else {
                        die('Something went wrong while saving the post');
                    }
                } catch (Exception $e) {
                    die('Database error: ' . $e->getMessage());
                }
            } else {
                $this->view('posts/add', $data);
            }
        } else {
            // Show empty form
            $data = [
                'title' => '',
                'body' => '',
                'title_err' => '',
                'body_err' => ''
            ];
            
            $this->view('posts/add', $data);
        }
    }

    // Alternative route for form submission
    public function store() {
        $this->add();
    }

    // Edit existing post - admins can edit any post, users can only edit their own
    public function edit($id) {
        try {
            require_once '../app/libraries/Database.php';
            $db = new Database();
            $db->query("SELECT * FROM posts WHERE id = :id");
            $db->bind(':id', $id);
            $post = $db->single();
            
            if (!$post) {
                redirect('posts');
                return;
            }
            
            // Check if user can edit this post
            $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
            if ($post->user_id != $_SESSION['user_id'] && !$isAdmin) {
                redirect('posts');
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'title_err' => '',
                    'body_err' => ''
                ];

                if (empty($data['title'])) {
                    $data['title_err'] = 'Please enter a title';
                }

                if (empty($data['body'])) {
                    $data['body_err'] = 'Please enter body text';
                }

                if (empty($data['title_err']) && empty($data['body_err'])) {
                    $db->query("UPDATE posts SET title = :title, message = :message, updated_at = NOW() WHERE id = :id");
                    $db->bind(':title', $data['title']);
                    $db->bind(':message', $data['body']);
                    $db->bind(':id', $data['id']);
                    
                    if ($db->execute()) {
                        flash('post_message', 'Post Updated');
                        redirect('posts');
                    } else {
                        die('Something went wrong while updating the post');
                    }
                } else {
                    $data['post'] = $post;
                    $this->view('posts/edit', $data);
                }
            } else {
                $data = [
                    'post' => $post,
                    'title_err' => '',
                    'body_err' => ''
                ];
                $this->view('posts/edit', $data);
            }
        } catch (Exception $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    // Delete post - admins can delete any post, users can only delete their own
    public function delete($id) {
        try {
            require_once '../app/libraries/Database.php';
            $db = new Database();
            $db->query("SELECT * FROM posts WHERE id = :id");
            $db->bind(':id', $id);
            $post = $db->single();
            
            if (!$post) {
                redirect('posts');
                return;
            }
            
            // Check if user can delete this post
            $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
            if ($post->user_id != $_SESSION['user_id'] && !$isAdmin) {
                redirect('posts');
                return;
            }

            $db->query("DELETE FROM posts WHERE id = :id");
            $db->bind(':id', $id);
            
            if ($db->execute()) {
                flash('post_message', 'Post Removed');
                redirect('posts');
            } else {
                die('Something went wrong while deleting the post');
            }
        } catch (Exception $e) {
            die('Database error: ' . $e->getMessage());
        }
    }
}
?>