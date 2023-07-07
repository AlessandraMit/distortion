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

    }
    
    public function delete() {
        
        if(isset($_SESSION['rank']) && $_SESSION['rank'] == 1) {
            
            $room = new Room();
            $room->setId($_GET['idRoom']);
            
            $messageManager = new MessageManager();
            $messageManager->deleteByRoom($room);
            
            $roomManager = new RoomManager();
            $roomManager->delete($room);
            
            
            header('Location: index.php');
            
        } else {
            
            header('Location: index.php');
        }
    }
    
}