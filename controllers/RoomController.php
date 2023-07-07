<?php

require_once './models/Room.php';
require_once './models/RoomManager.php';
require_once './models/CategoryManager.php';

class RoomController {
    
    public function add() {
        
        
        $roomManager = new RoomManager();
        $categoryManager = new CategoryManager();
    
        if(isset($_POST['room'])) {
            if(!empty($_POST['room'])) {
            
            
                $room = new Room();
                
                $room->setName($_POST['room']);
                $room->setCategoryId($_POST['cat_id']);
                
                $roomManager->insert($room); 
                    
                header('Location: index.php?page=add_room');
                exit();
            } else {
                $error = "Veuillez saisir un nom pour votre salon";
            }
        }
    
        $categories = $categoryManager->selectAll();
        
        $rooms = $roomManager->selectAll();
            
    
        require './views/add_room.phtml';
        
    }    
}

?>