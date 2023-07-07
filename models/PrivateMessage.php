<?php 

require_once './models/Model.php';

class PrivateMessage extends Model {
    
    private ?int $senderId;
    
    private DateTime $createdAt;
    
    private string $content;
    
    private ?int $receverId;
    
    
    public function getSenderId(): ?int {
        return $this->senderId;
    }
    
    public function setSenderId(?int $senderId): void {
        $this->senderId = $senderId;
    }
    
    public function getCreatedAt(): ?DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }
    
    public function getContent(): ?string {
        return $this->content;
    }
    
    public function setContent(?string $content): void {
        $this->content = $content;
    }
    
    
    public function getReceverId(): ?int {
        return $this->receverId;
    }
    
    public function setReceverId(?int $receverId): void {
        $this->receverId = $receverId;
    }
   
}; 


?>