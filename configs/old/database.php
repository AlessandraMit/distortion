<?php

const DB_HOST = 'db.3wa.io';
const DB_PORT = '3306';
const DB_NAME = 'alessandramitrache_distortion';
const DB_USERNAME = 'alessandramitrache';
const DB_PASSWORD = 'b2c026038aa12baae00aded018831a48';

function getConnexion(): PDO {

    return new PDO(
        'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';charset=UTF8',
        DB_USERNAME,
        DB_PASSWORD, [
            // Option qui permet de ne récupérer que le nom des colonnes
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC    
        ]
    );
}