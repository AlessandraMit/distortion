<?php

require './models/RoomManager.php';

$roomManager = new RoomManager();
$categories = $roomManager->selectRoomsByCategories();
// var_dump($categories);
// die();
// Appeler la vue qui affichera ces catégories et ces salles
$title = 'Accueil';
require './views/home.phtml';