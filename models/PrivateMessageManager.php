<?php

require_once './models/Manager.php';

class PrivateMessageManager extends Manager {
    
    
    public function insert(PrivateMessage $private_message) {
        
        
        $query = $this->db->prepare("INSERT INTO private_messages (content, sender_id, recever_id, created_at) VALUES (:content, :sender_id, :recever_id, :created_at);");
        $query->bindValue(':content', $message->getContent());
        $query->bindValue(':sender_id', $message->getSenderId());
        $query->bindValue(':recever_id', $message->getReceverId());
        $query->bindValue(':created_at', $message->getCreatedAt()->format('Y-m-d H:i:s'));
        
        // $query->execute($parameters);
        $query->execute();
    }

    
}