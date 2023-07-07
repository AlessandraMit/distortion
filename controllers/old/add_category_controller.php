<?php

require './models/Category.php';
require './models/CategoryManager.php';

$manager = new CategoryManager();

if(isset($_POST['category'])) {

    if($_POST['category'] != '') {
        
        $category = new Category();
        $category->setName($_POST['category']);
        
        $manager->insert($category);
        
        header('Location: index.php?page=add_category');
        exit();
        
    } else {
        $error = "Veuillez saisir un nom pour votre catégorie";
        
        $categories = $manager->selectAll();
    }
    
} else {
    $categories = $manager->selectAll();
}

require './views/add_category.phtml';