<?php


function getAllCategories(): array
{
    $db = getConnexion();
    
    $query = $db->prepare('SELECT id, name FROM categories ORDER BY name');
    $query->execute();
    
    $categories = $query->fetchAll();
    
    return $categories;
}


function createCategory(Category $category): void
{
    $db = getConnexion();
    
    $parameters = [
        "category" => $category->getName()
    ];

    $query = $db->prepare("INSERT INTO categories (name) VALUES ( :category )");

    $query->execute($parameters);
}