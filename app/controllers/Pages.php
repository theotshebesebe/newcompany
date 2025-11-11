<?php

class Pages extends Controller {
    // Load the home page
    public function index() {
        $this->view('pages/index');
    }

    // Load the about page
    public function about() {
        $this->view('pages/about');
    }
}
?>