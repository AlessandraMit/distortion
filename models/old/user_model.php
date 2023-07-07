<?php


function createUser(User $user): string {
                        
    $db = getConnexion();
    
    $parameters = [
        
        'firstName' => $user->getFirstName(),
        'lastName' => $user->getLastName(),
        'email' => $user->getEmail(),
        'password' => hash('sha256', $user->getPassword()),
        'login' => $user->getLogin()
        
    ];

    $query = $db->prepare("
        INSERT INTO users (
            first_name,
            last_name,
            email,
            password,
            login
        ) 
        
        VALUES (
            :firstName, 
            :lastName, 
            :email, 
            :password, 
            :login 
            
        )
    ");

    $query->execute($parameters);
    
    return $db->lastInsertId();
}    

function getUser(string $login, string $password) : ?array {
    
    $db = getConnexion();
    
    $parameters = [
        'login'    => $login,
        'password' => hash('sha256', $password)
    
    ];
    
    $query = $db->prepare("
        SELECT * 
        FROM users 
        WHERE login = :login AND password = :password
        
    ");
    
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
        SELECT * 
        FROM users 
        WHERE users.id = :id
        
    ");
    
    $query->execute($parameters);
    
    $user = $query->fetch();
    
    return $user;
    
    
}

function updateUser(int $id, string $first_name, string $last_name, string $email, string $login, ?string $file){ 

    
    $db = getConnexion();
    
    $parameters = [
        'first_name' => $first_name,
        'last_name'  => $last_name,
        'email'      => $email,
        'login'      => $login,
        'id'         => $id,
        'file'       => $file
    ];
    
    $query = $db->prepare("
        UPDATE users
        SET
            first_name = :first_name,
            last_name  = :last_name,
            email      = :email,
            login      = :login,
            file       = :file
        WHERE users.id = :id    
    
    ");
    
    $query->execute($parameters);

}

?>