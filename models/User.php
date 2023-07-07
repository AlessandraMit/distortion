<?php

require_once './models/Model.php';

class User extends Model {
    
    private string $login;
    
    private string $password;
    
    private string $email;
    
    private string $firstName;
    
    private string $lastName;
    
    private ?string $file;
    
    
  public function getLogin(): ?string {
        return $this->login;
    }
    
  public function setLogin( ?string $login): void {
        $this->login = $login;
    }
    
    public function getPassword(): string {
        return $this->password;
    }
    
    public function setPassword(string $password): void {
        $this->password = $password;
    }
    
  public function getEmail(): ?string {
        return $this->email;
    }
    
  public function setEmail(?string $email): void {
        $this->email = $email;
    }
    
  public function getFirstName(): ?string {
        return $this->firstName;
    }
    
  public function setFirstName(?string $firstName): void {
        $this->firstName = $firstName;
    }
    
  public function getLastName(): ?string {
        return $this->lastName;
    }
    
  public function setLastName(?string $lastName): void {
        $this->lastName = $lastName;
    }
    
  public function getFile(): ?string {
        return $this->file;
    }
    
  public function setFile(?string $file): void {
        $this->file = $file;
    }
    
};

$user = new User();


?>

