<?php

require './models/room_model.php';

$categories = getRoomsByCategories();
// var_dump($categories);
// die();
// Appeler la vue qui affichera ces catégories et ces salles
$title = 'Accueil';
require './views/home.phtml';