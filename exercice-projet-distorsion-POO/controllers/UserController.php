<?php

require_once './models/User.php';
require_once './models/UserManager.php';

class UserController {
    
    public function add() {
        
        // si on soumet le formulaire
        if(!empty($_POST)){
            
            $errors = [];
            
            foreach($_POST as $key => $data) {
                
                if($data === '') {
                    $errors[$key] = 'Le champ '.$key.' ne doit pas être vide.';
                }
            }
            
            // verif sur tous les champs obligatoire
            
            // si tous les champs sont ok -> insertion dans la BDD -> createUser(parametres)
            if(count($errors) === 0) {
                
                // $_POST['login'], $_POST['password'], $_POST['email'], $_POST['first-name'], $_POST['last-name'], $_POST['birthdate']
                
                $user = new User();
                $user->setLogin($_POST['login']);
                $user->setPassword($_POST['password']);
                $user->setEmail($_POST['email']);
                $user->setFirstName($_POST['first-name']);
                $user->setLastName($_POST['last-name']);
                $user->setBirthDate(new DateTime($_POST['birthdate']));
                
                $userManager = new UserManager();
                
                if($userManager->isExisting($user)) {
                    
                    $userAlreadyExist = "L'identifiant existe déjà";
                    
                } else {
                    $_SESSION['id'] = $userManager->insert($user);
                    
                    $_SESSION['login'] = $user->getLogin();
            
                    header('Location: index.php?page=home&register=ok');
                }
            }
            
            // sinon -> affichage des messages d'erreurs
        }
        
        require './views/add_user.phtml';
    }
    
    
    public function connect() {
        
        if($_GET['page'] === 'logout') {
    
            session_destroy();
            
            header('Location: index.php');
            
        }
        
        if(!empty($_POST)) {
            
            $user = new User();
            $user->setLogin($_POST['login']);
            $user->setPassword($_POST['password']);
            
            $userManager = new UserManager();
            $user = $userManager->selectOneByLogin($user);
            
            if(!$user) {
                
                $error = 'Identifiants incorrects';
                
            } else {
                
                $_SESSION['id'] = $user['id'];
                $_SESSION['login'] = $user['login'];
                $_SESSION['avatar'] = $user['file'];
                $_SESSION['rank'] = $user['rank'];
                
                header('Location: index.php');
            }
            
        }
        
        require './views/login.phtml';
    }
    
    public function update() {
        
        $userManager = new UserManager();
        
        $user = $userManager->selectOneById($_SESSION['id']);
        
        $oldLogin = $user['login'];
        
        if(!empty($_POST)) {
            
            $errors = [];
            
            foreach($_POST as $key => $data) {
                
                if($data === '') {
                    $errors[$key] = 'Le champ '.$key.' ne doit pas être vide.';
                }
            }
            
            if(count($errors) === 0) {
            
                if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                    
                    $file = $_FILES['file']['name'];
                    
                } elseif(isset($_SESSION['avatar']) && $_SESSION['avatar'] != null) {
                    
                    $file = $_SESSION['avatar'];
                    
                } else {
                    $file = null;
                }
                
                $user = new User();
                $user->setId($_SESSION['id']);
                $user->setLogin($_POST['login']);
                $user->setEmail($_POST['email']);
                $user->setFirstName($_POST['first-name']);
                $user->setLastName($_POST['last-name']);
                $user->setBirthDate(new DateTime($_POST['birthdate']));
                $user->setFile($file);
                
                if($userManager->isExisting($user) && $user->getLogin() !== $oldLogin) {
                        
                    $userAlreadyExist = "L'identifiant existe déjà";
                        
                } else {
                    $userManager->update($user);
                    
                    if(!is_dir('uploads/avatars/'.$_SESSION['id'])) {
                        mkdir('uploads/avatars/'.$_SESSION['id']);
                    }
                
                    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/avatars/'.$_SESSION['id'].'/'.$_FILES['file']['name']);
                    
                    $_SESSION['login'] = $user->getLogin();
                    $_SESSION['avatar'] = $file;
                }
            }
            $user = $userManager->selectOneById($_SESSION['id']);
            
        }
        
        require './views/profil.phtml';

    }
    
}