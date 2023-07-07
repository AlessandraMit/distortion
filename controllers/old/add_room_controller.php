<?php

require_once './models/Room.php';
require_once './models/RoomManager.php';
require_once './models/CategoryManager.php';

// Ajout du nouveau salon


$roomManager = new RoomManager();
$categoryManager = new CategoryManager();

if(isset($_POST['room'])) {
    if(!empty($_POST['room'])) {
    
        // créer un objet 'Room'
        $room = new Room();
        
        // l'hydrater
        $room->setName($_POST['room']);
        $room->setCategoryId($_POST['cat_id']);
        
        $roomManager->insert($room); // envoyer l'objet Room en parametre de la fonction
            
        header('Location: index.php?page=add_room');
        exit();
    } else {
        $error = "Veuillez saisir un nom pour votre salon";
    }
}
// Récupération des catégories
$categories = $categoryManager->selectAll();

// Récupération des salons
$rooms = $roomManager->selectAll();
    

require './views/add_room.phtml';



