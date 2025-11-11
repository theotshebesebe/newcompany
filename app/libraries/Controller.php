<?php
// filepath: /newcompany/newcompany/app/libraries/Controller.php

// Base Controller class that other controllers will extend
class Controller {
    // Load model
    public function model($model) {
        // Require the model file
        require_once '../app/models/' . $model . '.php';
        // Instantiate the model
        return new $model();
    }

    // Load view
    public function view($view, $data = []) {
        // Check if the view file exists
        if (file_exists('../app/views/' . $view . '.php')) {
            // Extract data to variables
            extract($data);
            // Require the view file
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }
}
?>