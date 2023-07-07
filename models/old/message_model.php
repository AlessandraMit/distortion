<?php


function createMessage(Message $message): void
{
    $db = getConnexion();
    
    
    $parameters = [
        "content"      => $message->getContent(),
        "room_id"      => $message->getRoomId(),
        "user_id"      => $message->getUserId()
        
    ];

    $query = $db->prepare("INSERT INTO messages (content, room_id, user_id) VALUES ( :content, :room_id, :user_id )");

    $query->execute($parameters);
}    

    
function getMessagesByRoom(int $roomId) : array {
    
    $db = getConnexion();
    
     $parameters = [
        "room_id" => $roomId
    ];
    
    $query = $db->prepare 
    ("
        SELECT * 
        FROM messages
        LEFT JOIN users ON users.id = messages.user_id
        WHERE room_id = :room_id 
        ORDER BY created_at DESC
        
    ");
    
    $query->execute($parameters);
    
    $messages = $query->fetchAll();
    
    // var_dump($messages);
    // die();
    
    return $messages;
}

?>
