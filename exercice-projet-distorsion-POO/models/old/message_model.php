<?php


function createMessage(string $content, int $roomId) {
    
    $db = getConnexion();
    
    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
    } else {
        $id = null;
    }
    
    $parameters = [
        'content' => $content,
        'room_id' => $roomId,
        'user_id' => $id
    ];
    
    $query = $db->prepare("INSERT INTO messages (content, room_id, user_id) VALUES (:content, :room_id, :user_id);");
    
    $query->execute($parameters);
}

function getMessagesByRoom(int $roomId) {
    
    $db = getConnexion();
    
    $parameters = [
        'room_id' => $roomId
    ];
    
    $query = $db->prepare("
        SELECT *
        FROM messages
        LEFT JOIN users ON users.id = messages.user_id
        WHERE room_id = :room_id
        ORDER BY created_at DESC
    ");
    
    $query->execute($parameters);
    
    $messages = $query->fetchAll();
    
    
    return $messages;
}

?>