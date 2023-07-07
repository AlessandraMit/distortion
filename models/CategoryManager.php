<?php

require_once './models/Manager.php';

class CategoryManager extends Manager {
    
    public function insert(Category $category): void {
        
        $parameters = [
            "category" => $category->getName()
        ];
    
        $query = $this->db->prepare("INSERT INTO categories (name) VALUES ( :category )");
    
        $query->execute($parameters);
    }
    
    public function selectAll(): array {
        
        $query = $this->db->prepare('SELECT id, name FROM categories ORDER BY name');
        $query->execute();
        
        $categories = $query->fetchAll();
        
        return $categories;
    }
    
}