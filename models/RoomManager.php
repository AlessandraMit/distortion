<?php 
require_once './models/Manager.php';

class RoomManager extends Manager {
    
        /**
     * Renvoie tous les salons
     */
    public function selectAll(): array
    {
        
        $query = $this->db->prepare('SELECT id, name FROM rooms ORDER BY name');
        $query->execute();
        $rooms = $query->fetchAll();
        
        return $rooms;
    }

    public function insert(Room $room): void // 1 seul parametre de type Room
    {
        
        $parameters = [
            "room"      => $room->getName(), // utiliser les accesseurs de cla class Room
            "cat_id"    => $room->getCategoryId() // utiliser les accesseurs de cla class Room
        ];
    
        $query = $this->db->prepare("INSERT INTO rooms (name, category_id) VALUES ( :room, :cat_id )");
    
        $query->execute($parameters);
    }
    
    public function selectRoomsByCategories(): array
    {
        // Récupérer la liste des catégories et salles
        $query = $this->db->prepare(
            'SELECT r.id, r.name AS roomName, r.category_id, c.name AS categoryName
            FROM rooms r
            INNER JOIN categories c ON r.category_id = c.id
            ORDER BY c.name, r.name'
        );
        
        $query->execute();
        
        $rooms = $query->fetchAll();
        
        // var_dump($rooms);
        
        $categories = [];
    
        // Pour chacun des salons
        foreach ($rooms as $room) {
            // On regarde si j'ai déjà un salon de cette catégorie
            // Si c'est le cas on ajoute le salon à cette catégorie
            if (isset($categories[$room['category_id']])) {
                $categories[$room['category_id']]['rooms'][$room['id']] = $room['roomName'];
            } else {
                // Sinon on crée une nouvelle catégorie et on ajoute le salon dedans
                $categories[$room['category_id']] = [
                    'name' => $room['categoryName'],
                    'rooms' => [
                        $room['id'] => $room['roomName']    
                    ]
                ];
            }
        }
        
        return $categories;
    }
    
}