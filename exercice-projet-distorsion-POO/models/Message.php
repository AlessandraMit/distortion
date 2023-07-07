<?php

require_once './models/Model.php';

class Message extends Model {
    
    private ?string $content;
    private ?DateTime $createdAt;
    private ?int $roomId;
    private ?int $userId;

    public function getContent(): ?string {
        return $this->content;
    }

    public function setContent(?string $content): void {
        $this->content = $content;
    }

    public function getCreatedAt(): ?DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }
    
    public function getRoomId(): ?int {
        return $this->roomId;
    }

    public function setRoomId(?int $roomId): void {
        $this->roomId = $roomId;
    }
    
    public function getUserId(): ?int {
        return $this->userId;
    }

    public function setUserId(?int $userId): void {
        $this->userId = $userId;
    }
    
}


?>