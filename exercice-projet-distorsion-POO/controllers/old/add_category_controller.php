<?php

require './models/category_model.php';

if(isset($_POST['category'])) {

    // Si $_POST['category'] n'est pas vide {
    if($_POST['category'] != '') {
        
        createCategory($_POST['category']);
        
        // Une fois la catégorie créée on redirige l'utilisateur
        header('Location: index.php?page=add_category');
        exit();
        
    } else {
        $error = "Veuillez saisir un nom pour votre catégorie";
        $categories = getAllCategories();
    }
    
} else {
    $categories = getAllCategories();
}

require './views/add_category.phtml';














