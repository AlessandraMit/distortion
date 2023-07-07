<?php

require_once './models/Message.php';
require_once './models/MessageManager.php';

class MessageController {
    
    public function add() {
        
        
        $roomManager = new RoomManager();
        $categories = $roomManager->selectRoomsByCategories();
        
        $messageManager = new MessageManager();
        
     
        if(isset($_POST['content'])) {
            if(!empty($_POST['content'])) {
                
                $message = new Message();
             
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
        
   
        $messages = $messageManager->selectMessagesByRoom($_GET['id']);
        
        require './views/add_message.phtml';
    }
}    

?>