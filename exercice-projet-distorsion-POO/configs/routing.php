<?php

// Liste de toutes les routes
const AVAILABLE_ROUTES = [
    'home'          => 'home_controller.php',
    'add_category'  => 'add_category_controller.php',
    'add_room'      => 'add_room_controller.php',
    'chat'          => 'add_message_controller.php',
    'register'      => 'add_user_controller.php',
    'logout'        => 'login_controller.php',
    'login'         => 'login_controller.php',
    'profil'        => 'update_profil_controller.php'
];

// Le nom de la route par défaut (lorsque le paramètre  page n'est pas fourni)
const DEFAULT_ROUTE = 'home';


// Appelle le contrôleur demandé
function getRouteFromQuery(): string {

    $avalableRoutesNames = array_keys(AVAILABLE_ROUTES);

    // $avalableRoutesNames = [
    //     'add_category'
    // ]

    // Si il n'existe pas de paramètre page dans la chaîne de requête (?page=...) ou si la route n'existe pas
    if(!isset($_GET['page']) || !in_array($_GET['page'], $avalableRoutesNames)) {
        // On appelle le contrôleur de la route par défaut
        return realpath('controllers/'.AVAILABLE_ROUTES[DEFAULT_ROUTE]);
    }

    // return realpath('controllers/add_category_controller.php');
    // return realpath('controllers/'.AVAILABLE_ROUTES['add_category']);
    
    // Appel du contrôleur de la route spécifiée dans l'url
    return realpath('controllers/'.AVAILABLE_ROUTES[$_GET['page']]);
}