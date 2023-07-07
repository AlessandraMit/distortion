<?php

class User {
    
    public int $id;
    
    public string $login;
    
    public string $password;
    
    public string $email;
    
    public string $firstName;
    
    public string $lastName;
    
    public string $birthDate;
    
    public string $file;
    
    
//     __construct automatiquement appelé quand on a une nouvelle abstance
    public function __construct(string $login, string $firstName, string $lastName) {
        $this->login = $login;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        
    }
    
    
// //méthodes à l'intérieur d'une classe//    
public function connect(): void {
    
    //je regarde si l'utilisateur existe dans la BDD
    
    //si oui je renseigne ma variable $_SESSION
    
    //si non j'affiche ou je retroune un msg d'erreur
    
    }
}

$user = new User('test', 'Alex', 'Mit');
$user->connect();
    
var_dump($user);



//*AUTRE FACON*//

    public function __construct(string $login) {
        $this->login = $login;
    };    

$user = new User();
$user->login = 'Alex';

$user->connect();
    
var_dump($user);


?>




<!--accesceur && mutateur -->
<!--get et set-->


<!--get acceder -->
 
<?php

class User {
    
    private int $id;
    private string $login;
    private string $password;
    private string $email;
    private string $firstName;
    private string $lastName;
    private DateTime $birthDate;
    private string $file;
    
    private function sayHello(): void {
        echo 'Bonjour';
    }
    
    public function getId(): int {
        return $this->id;
    }
}

$user = new User();
// $user->getId();


// <!--set muter une valeur-->


class User {
    
    private int $id;
    private string $login;
    private string $password;
    private string $email;
    private string $firstName;
    private string $lastName;
    private DateTime $birthDate;
    private string $file;
    
    private function sayHello(): void {
        echo 'Bonjour';
    }
    
    public function setId(int $id): void {
        $this->id = $id;
    }
    
$user = new User();    
}

?>
    
   