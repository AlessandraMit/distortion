<?php

require './models/message_model.php';
require './models/Message.php';
require './models/MessageManager.php';
require './models/RoomManager.php';


$roomManager = new RoomManager();
$categories = $roomManager->selectRoomsByCategories();

$messageManager = new MessageManager();

// si j'ai validé le formulaire de message {
if(isset($_POST['content'])) {
    if(!empty($_POST['content'])) {
        // insertion du message dans la BDD
        // appel à la fonction createMessage()
        
        $message = new Message();
        // $_POST['content'], $_GET['id']
        $message->setContent($_POST['content']);
        $message->setRoomId($_GET['id']);
        
        $date = new DateTime();
        
        $message->setCreatedAt($date);
        
        if(isset($_SESSION['id'])) {
            $message->setUserId($_SESSION['id']);
        } else {
            $message->setUserId(null);
        }
        
        $messageManager->insert($message);
        
    } else {
        $error = "Veuillez saisir un message";
    }
}

// récupérer la liste des message du salon :
    // appel à la fonction getMessagesByRoom()
    
$messages = $messageManager->selectMessagesByRoom($_GET['id']);

// var_dump($messages);
// die();

require './views/add_message.phtml';

?>