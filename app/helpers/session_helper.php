<?php
// session_helper.php

// Start the session if it hasn't been started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Set a session variable
 *
 * @param string $key The key for the session variable
 * @param mixed $value The value to be stored in the session
 */
function set_session($key, $value) {
    $_SESSION[$key] = $value;
}

/**
 * Get a session variable
 *
 * @param string $key The key for the session variable
 * @return mixed The value of the session variable or null if not set
 */
function get_session($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}

/**
 * Check if a session variable is set
 *
 * @param string $key The key for the session variable
 * @return bool True if the session variable is set, false otherwise
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Check if a user is logged in
 *
 * @return bool True if the user is logged in, false otherwise
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Set a flash message
 *
 * @param string $name The name of the flash message
 * @param string $message The message content
 * @param string $class The CSS class for styling (optional)
 */
function flash($name = '', $message = '', $class = 'alert alert-success') {
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

/**
 * Unset a session variable
 *
 * @param string $key The key for the session variable
 */
function unset_session($key) {
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}

/**
 * Destroy the session
 */
function logout() {
    session_destroy();
    header('Location: /newcompany/public/users/login.php'); // Redirect to login page after logout
    exit();
}
?>