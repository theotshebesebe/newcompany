<?php

class Core {
    // Default controller and method settings
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        $this->parseUrl();
        $this->callControllerMethod();
    }

    // Parse URL to determine controller, method, and parameters
    protected function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Check if controller file exists
            if (!empty($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
                $this->currentController = ucfirst($url[0]);
                unset($url[0]);
            }

            // Set method if provided
            if (isset($url[1]) && !empty($url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }

            // Remaining URL parts become parameters
            $this->params = $url ? array_values($url) : [];
        }
        
        // Load and instantiate the controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;

        // Fallback to index if method doesn't exist
        if (!method_exists($this->currentController, $this->currentMethod)) {
            $this->currentMethod = 'index';
        }
    }

    // Call the controller method with parameters
    protected function callControllerMethod() {
        call_user_func_array(
            [$this->currentController, $this->currentMethod], 
            $this->params
        );
    }
}
?>