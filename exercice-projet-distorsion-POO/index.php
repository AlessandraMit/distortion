<?php
// phpinfo();
// die();

declare(strict_types=1);

date_default_timezone_set('Europe/Paris');

session_start();

require_once './configs/Database.php';
require_once './configs/Router.php';

require_once './controllers/HomeController.php';
require_once './controllers/CategoryController.php';
require_once './controllers/RoomController.php';
require_once './controllers/MessageController.php';
require_once './controllers/UserController.php';

$router = new Router();

require_once './views/layout.phtml';
