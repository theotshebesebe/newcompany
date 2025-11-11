<?php

class Users extends Controller {
    
    public function __construct() {
        // Using direct database queries instead of models for simplicity
    }
    
    // Display registration form
    public function register() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/profile');
            exit();
        }

        $data = [
            'name' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
        ];
        $this->view('users/register', $data);
    }

    // Process user registration
    public function registerUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter your name';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter your email';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Please enter a valid email';
            } else {
                // Check if email already exists
                try {
                    require_once '../app/libraries/Database.php';
                    $db = new Database();
                    $db->query("SELECT email FROM users WHERE email = :email");
                    $db->bind(':email', $data['email']);
                    $db->execute();
                    if ($db->rowCount() > 0) {
                        $data['email_err'] = 'Email is already taken';
                    }
                } catch (Exception $e) {
                    // Continue without email check if database fails
                }
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm your password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Create user if validation passes
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

                try {
                    require_once '../app/libraries/Database.php';
                    $db = new Database();
                    $db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
                    $db->bind(':name', $data['name']);
                    $db->bind(':email', $data['email']);
                    $db->bind(':password', $hashedPassword);
                    
                    if ($db->execute()) {
                        echo "<div class='container mt-5'>";
                        echo "<div class='alert alert-success text-center'>";
                        echo "<h4>Registration Successful!</h4>";
                        echo "<p>Your account has been created successfully. You can now <a href='" . URLROOT . "/users/login'>login here</a>.</p>";
                        echo "</div>";
                        echo "</div>";
                        exit();
                    } else {
                        die('Something went wrong with registration');
                    }
                } catch (Exception $e) {
                    die('Database error: ' . $e->getMessage());
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            header('Location: ' . URLROOT . '/users/register');
        }
    }

    // Display login form
    public function login() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/profile');
        }

        $data = [];
        $this->view('users/login', $data);
    }

    // Process user login
    public function loginUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];

            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter your email';
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter your password';
            }

            if (empty($data['email_err']) && empty($data['password_err'])) {
                try {
                    require_once '../app/libraries/Database.php';
                    $db = new Database();
                    $db->query("SELECT * FROM users WHERE email = :email");
                    $db->bind(':email', $data['email']);
                    $loggedInUser = $db->single();
                    
                    if ($loggedInUser && password_verify($data['password'], $loggedInUser->password)) {
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['password_err'] = 'Invalid email or password';
                        $this->view('users/login', $data);
                    }
                } catch (Exception $e) {
                    die('Database error: ' . $e->getMessage());
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            header('Location: ' . URLROOT . '/users/login');
        }
    }

    // Create user session with admin status
    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['is_admin'] = isset($user->is_admin) ? $user->is_admin : 0;
        header('Location: ' . URLROOT . '/users/profile');
    }

    // Display user profile
    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
        }

        $data = [];
        $this->view('users/profile', $data);
    }

    // Handle user logout
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        header('Location: ' . URLROOT . '/users/login');
    }
}
?>