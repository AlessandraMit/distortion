<?php

require_once './models/Model.php';

class Room extends Model {
    
    private string $name;
    private int $categoryId;
    
    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }
    
    public function getCategoryId(): ?int {
        return $this->categoryId;
    }

    public function setCategoryId(?int $categoryId): void {
        $this->categoryId = $categoryId;
    }
}


?>