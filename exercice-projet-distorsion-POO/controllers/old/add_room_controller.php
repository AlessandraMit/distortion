<?php

require './models/category_model.php';
require './models/room_model.php';

// Ajout du nouveau salon

if(isset($_POST['room'])) {
    if(!empty($_POST['room'])) {
    
        // var_dump($_POST);
        createRoom($_POST['room'], $_POST['cat_id']);
            
        header('Location: index.php?page=add_room');
        exit();
    } else {
        $error = "Veuillez saisir un nom pour votre salon";
    }
}
// Récupération des catégories
$categories = getAllCategories();

// Récupération des salons
$rooms = getAllRooms();
    

require './views/add_room.phtml';



