<?php 

declare(strict_types=1);

require_once './models/Manager.php';

class UserManager extends Manager {
    
        
    public function insert(User $user): string {
        
        // penser à crypter le password (fonction hash())
        
        $parameters = [
            'login' => $user->getLogin(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'email' => $user->getEmail(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'birthDate' => $user->getBirthDate()->format('Y-m-d H:i:s')
        ];
        
        $query = $this->db->prepare("
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
        
        return $this->db->lastInsertId();
        
    }
    
    public function selectOneByLogin(User $user): array|bool {
        
        $parameters = [
            'login'     => $user->getLogin(),
            'password'  => password_hash($user->getPassword(), PASSWORD_DEFAULT),
        ];
        
        $query = $this->db->prepare("SELECT * FROM users WHERE login = :login AND password = :password");
        
        $query->execute($parameters);
        
        $user = $query->fetch();
        
        return $user;
        
    }
    
    public function selectOneById(int $id) {
        
        $parameters = [
            'id' => $id    
        ];
        
        $query = $this->db->prepare("
            SELECT * FROM users WHERE users.id = :id
        ");
        
        $query->execute($parameters);
        
        $user = $query->fetch();
        
        return $user;
        
    }
    
    function update(User $user) {
        
        $parameters = [
            'login'     => $user->getLogin(),
            'email'     => $user->getEmail(),
            'firstName' => $user->getFirstName(),
            'lastName'  => $user->getLastName(),
            'birthDate' => $user->getBirthDate()->format('Y-m-d'),
            'id'        => $user->getId(),
            'file'      => $user->getFile()
        ];
        
        $query = $this->db->prepare("
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
    
    public function isExisting(User $user): bool {
        
        $parameters = [
            'login'     => $user->getLogin()
        ];
        
        $query = $this->db->prepare("SELECT * FROM users WHERE login = :login");
        
        $query->execute($parameters);
        
        $user = $query->fetch();
        
        if(isset($user['id'])) {
            return true;
        } else {
            return false;
        }
    }
}