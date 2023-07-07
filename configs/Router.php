<?php

// const AVAILABLE_ROUTES = [
    
//     'add_category' => {
//         'action'  => ['CategoryController.php', 'add']
//     }
    
// ];


class Router {
    
    private array $routes;
    
    public function __construct() {
        $this->routes = require './configs/routes.php';
    }
    
    public function callActionFromRequest(): void {
        if(isset($_GET['page']) && !empty($_GET['page'])) {
            $route = $this->routes[$_GET['page']];
        } else {
            $route = $this->routes['home'];
        }
        
        // $route : ['action' => [HomeController::class, 'home']]
        
        // $controller = new HomeController;
        $controller = new $route['action'][0];
        
        // $controller->home();
        $controller->{$route['action'][1]}();
    }
}