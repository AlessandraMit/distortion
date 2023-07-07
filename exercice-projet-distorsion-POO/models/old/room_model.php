<?php

/**
 * Renvoie tous les salons
 */
function getAllRooms(): array
{
    $db = getConnexion();
    
    $query = $db->prepare('SELECT id, name FROM rooms ORDER BY name');
    $query->execute();
    $rooms = $query->fetchAll();
    
    return $rooms;
}

function createRoom(string $name, int $categoryId): void
{
    $db = getConnexion();
    
    $parameters = [
        "room"      => $name,
        "cat_id"    => $categoryId
    ];

    $query = $db->prepare("INSERT INTO rooms (name, category_id) VALUES ( :room, :cat_id )");

    $query->execute($parameters);
}

function getRoomsByCategories(): array
{
    $db = getConnexion();

    // Récupérer la liste des catégories et salles
    $query = $db->prepare(
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
    
    // var_dump($categories);
    // die();
    
    return $categories;
}