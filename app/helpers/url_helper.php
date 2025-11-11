<?php
// This helper file contains functions for generating URLs and redirecting users to different pages.

/**
 * Redirect to a specific page
 *
 * @param string $page The page to redirect to
 * @return void
 */
function redirect($page) {
    header('Location: ' . URLROOT . '/' . $page);
    exit();
}

/**
 * Generate a URL for a specific route
 *
 * @param string $route The route to generate the URL for
 * @return string The generated URL
 */
function url($route) {
    return URLROOT . '/' . $route;
}

/**
 * Generate a URL for a specific controller and method
 *
 * @param string $controller The controller name
 * @param string $method The method name
 * @return string The generated URL
 */
function urlTo($controller, $method) {
    return URLROOT . '/' . $controller . '/' . $method;
}
?>