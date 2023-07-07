<?php

// Fichier modèle (dans l'architecture MVC)
// Dans ce fichier on va regrouper tous les appels à la base de données
// Et plus spécifiquement les appels à la table des catégories

/**
 * Renvoie la liste des catégories
 */
function getAllCategories(): array
{
    $db = getConnexion();
    
    $query = $db->prepare('SELECT id, name FROM categories ORDER BY name');
    $query->execute();
    
    $categories = $query->fetchAll();
    
    return $categories;
}

/**
 * Ajoute une nouvelle catégorie
 */
function createCategory(string $name): void
{
    $db = getConnexion();
    
    $parameters = [
        "category" => $name
    ];

    $query = $db->prepare("INSERT INTO categories (name) VALUES ( :category )");

    $query->execute($parameters);
}