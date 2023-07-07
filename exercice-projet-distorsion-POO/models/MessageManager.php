<?php

declare(strict_types=1);

require_once './models/Manager.php';

class MessageManager extends Manager {
    
    
    public function insert($message) {
        
        // $parameters = [
        //     'content' => $message->getContent(),
        //     'room_id' => $message->getRoomId(),
        //     'user_id' => $message->getUserId()
        // ];
        
        $query = $this->db->prepare("INSERT INTO messages (content, room_id, user_id, created_at) VALUES (:content, :room_id, :user_id, :created_at);");
        $query->bindValue(':content', $message->getContent());
        $query->bindValue(':room_id', $message->getRoomId());
        $query->bindValue(':user_id', $message->getUserId());
        $query->bindValue(':created_at', $message->getCreatedAt()->format('Y-m-d H:i:s'));
        
        // $query->execute($parameters);
        $query->execute();
    }
    
    public function selectMessagesByRoom(int $roomId) {
        
        $parameters = [
            'room_id' => $roomId
        ];
        
        $query = $this->db->prepare("
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
    
    public function deleteByRoom(Room $room): void {
        
        $query = $this->db->prepare('DELETE FROM messages WHERE room_id = :room_id');
        $query->bindValue(':room_id', $room->getId());
        
        $query->execute();
    } 

    
}