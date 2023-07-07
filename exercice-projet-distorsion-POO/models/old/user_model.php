<?php

function createUser(string $login, 
                    string $password, 
                    string $email, 
                    string $firstName, 
                    string $lastName, 
                    string $birthDate
                    ): string {
    
    // penser à crypter le password (fonction hash())
    
    $db = getConnexion();
    
    $parameters = [
        'login' => $login,
        'password' => hash('sha256', $password),
        'email' => $email,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'birthDate' => $birthDate
    ];
    
    $query = $db->prepare("
        INSERT INTO users (
            login,
            password,
            email,
            first_name,
            last_name,
            birth_date
        ) VALUES (
            :login,
            :password,
            :email,
            :firstName,
            :lastName,
            :birthDate
        )
    ");
    
    $query->execute($parameters);
    
    return $db->lastInsertId();
    
}

function getUser(string $login, string $password): ?array {
    
    $db = getConnexion();
    
    $parameters = [
        'login'     => $login,
        'password'  => hash('sha256', $password)
    ];
    
    $query = $db->prepare("SELECT * FROM users WHERE login = :login AND password = :password");
    
    $query->execute($parameters);
    
    $user = $query->fetch();
    
    return $user;
    
}

function getUserById(int $id) {
    
    $db = getConnexion();
    
    $parameters = [
        'id' => $id    
    ];
    
    $query = $db->prepare("
        SELECT * FROM users WHERE users.id = :id
    ");
    
    $query->execute($parameters);
    
    $user = $query->fetch();
    
    return $user;
    
}

function updateUser(int $id, string $login, string $email, string $firstName, string $lastName, string $birthDate, ?string $file) {
    
    $db = getConnexion();
    
    $parameters = [
        'login'     => $login,
        'email'     => $email,
        'firstName' => $firstName,
        'lastName'  => $lastName,
        'birthDate' => $birthDate,
        'id'        => $id,
        'file'      => $file
    ];
    
    $query = $db->prepare("
        UPDATE users
        SET
            login = :login, 
            email = :email, 
            first_name = :firstName, 
            last_name = :lastName, 
            birth_date = :birthDate, 
            file = :file
        WHERE users.id = :id
    ");
    
    $query->execute($parameters);
    
}

?>