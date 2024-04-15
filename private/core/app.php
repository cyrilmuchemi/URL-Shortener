<?php

/**
 * Main Application
 */

class App {
    protected $controller = "home";
    protected $method = "index";
    protected $params = array();

    public function __construct()
    {
        $URL = $this->getURL();
        if(file_exists(dirname(__DIR__) . "/controllers/" . $URL[0] . ".php"))
        {
            $this->controller = ucfirst($URL[0]);
        }

        $filePath = dirname(__DIR__) . "/controllers/" . $this->controller . ".php";
        require $filePath;
        $this->controller = new $this->controller();
    }

    private function getURL()
    {
        $url = $_GET['url'] ?? 'home';
        $url = urldecode($url);
        $url = trim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        $url = array_filter($url);
        return $url;
    }
}