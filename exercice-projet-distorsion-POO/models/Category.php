<?php

require_once './models/Model.php';

class Category extends Model {
    
    private string $name;
    
    public function getName(): ?string {
        return $this->name;
    }
    
    public function setName(?string $name) {
        $this->name = $name;
    }
    
}


?>