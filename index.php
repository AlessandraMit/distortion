<?php

date_default_timezone_set('Europe/Paris');

// phpinfo();
// die();

session_start();

// require_once './configs/routing.php';
// require_once './configs/database.php';
require_once './configs/Database.php';
require_once './configs/Router.php';

require_once './controllers/HomeController.php';
require_once './controllers/CategoryController.php'; 
require_once './controllers/RoomController.php'; 
require_once './controllers/MessageController.php'; 
require_once './controllers/UserController.php';
require_once './controllers/PrivateMessageController.php'; 


$router = new Router();

// require './controllers/add_category_controller.php';
require_once './views/layout.phtml';