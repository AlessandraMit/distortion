<?php

require_once './models/Manager.php';

class UserManager extends Manager {
    

    public function insert(User $user): string {
                        
    
        $parameters = [
            
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'email' => $user->getEmail(),
            'password' => hash('sha256', $user->getPassword()),
            'login' => $user->getLogin()
            
        ];
    
        $query = $this->db->prepare("
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
        
        return $this->db->lastInsertId();
    }    

    public function selectOneByLogin(User $user) : ?array {
    
    
        $parameters = [
            'login'    => $user->getLogin(),
            'password' => hash('sha512', $user->getPassword())
        
        ];
        
        $query = $this->db->prepare("
            SELECT * 
            FROM users 
            WHERE login = :login AND password = :password
            
        ");
        
        $query->execute($parameters);
        
        $user = $query->fetch();
        
        return $user;
    }

    public function selectOneById(int $id) {
    
        $parameters = [
            
            'id' => $id
            
        ];
        
        $query = $this->db->prepare("
            SELECT * 
            FROM users 
            WHERE users.id = :id
            
        ");
        
        $query->execute($parameters);
        
        $user = $query->fetch();
        
        return $user;
        
        
    }

    public function update(User $user){ 

    
        $parameters = [
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'email'      => $email,
            'login'      => $login,
            'id'         => $id,
            'file'       => $file
        ];
        
        $query = $this->db->prepare("
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
    
    public function sameLogin(User $user){
     
        $parameters = [
            'login'    => $user->getLogin(),
            
        
        ];
        
        $query = $this->db->prepare("
            SELECT * 
            FROM users 
            WHERE login = :login 
            
        ");
        
        $query->execute($parameters);
        
        $user = $query->fetch();
        
        return $user;
        
    }
    
    public function selectAll() {
        
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        
        $users = $query->fetchAll();
        
        return $users;
    }
    
}


?>

