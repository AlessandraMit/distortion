<?php

require_once './models/Category.php';
require_once './models/CategoryManager.php';

class CategoryController {
    
    public function add() {
        
    $manager = new CategoryManager();
    
    if(isset($_POST['category'])) {
    
        if($_POST['category'] != '') {
            
            $category = new Category();
            $category->setName($_POST['category']);
            
            $manager->insert($category);
            
            header('Location: index.php?page=add_category');
            exit();
            
        } else {
            $error = "Veuillez saisir un nom pour votre catégorie";+
            
            $categories = $manager->selectAll();
        }
        
    } else {
        $categories = $manager->selectAll();
    }
    
        require './views/add_category.phtml';
    }            
        
}


?>