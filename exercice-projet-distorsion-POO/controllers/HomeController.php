<?php

require_once './models/RoomManager.php';

class HomeController {
    
    public function home(): void {
        
        $roomManager = new RoomManager();
        $categories = $roomManager->selectRoomsByCategories();
        
        $title = 'Accueil';
        require './views/home.phtml';
        
    }
    
}