<?php

require './models/message_model.php';
require './models/room_model.php';

$categories = getRoomsByCategories();

// si j'ai validé le formulaire de message {
if(isset($_POST['content'])) {
    if(!empty($_POST['content'])) {
        // insertion du message dans la BDD
        // appel à la fonction createMessage()
        
        createMessage($_POST['content'], $_GET['id']);
        
    } else {
        $error = "Veuillez saisir un message";
    }
}

// récupérer la liste des message du salon :
    // appel à la fonction getMessagesByRoom()
    
$messages = getMessagesByRoom($_GET['id']);

// var_dump($messages);
// die();

require './views/add_message.phtml';

?>