<?php

require_once './models/User.php';
require_once './models/UserManager.php';

class UserController {
    
    public function add() {
        
        
        if(!empty($_POST)) {
                
            $errors = [];
                
            foreach($_POST as $key => $data) {
                
                if($data === ''){
                    $errors[$key] = 'Le champ '.$key.' ne doit pas être vide.';
                }
            }    
            
            if(count($errors) === 0 ){
                
                
                $user = new User();
                
                $user->setfirstName($_POST['first_name']);
                $user->setlastName($_POST['last_name']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setLogin($_POST['login']);
                
                $userManager = new UserManager();
                
                $userCheck = $userManager->sameLogin($user);
                
                if(!$userCheck) {
                    
                    $_SESSION['id'] = $userManager->insert($user);
                    
                    $_SESSION['login'] = $user->getLogin();
            
                    header('Location: index.php?page=home&register=ok');
                    
                } else {
                    
                    $errorLogin = "Ce nom d'utilisateur est déjà utilisé !";
                    
                }    
                
            }    
            
                    
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
                $user->setfirstName($_POST['first_name']);
                $user->setlastName($_POST['last_name']);
                $user->setEmail($_POST['email']);
                $user->setLogin($_POST['login']);
                $user->setFile($file);
                
                if($userManager->sameLogin($user) && $user->getLogin() !== $oldLogin) {
                        
                    $userAlreadyExist = "Ce nom d'utilisateur est déjà utilisé !";
                        
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
    
    
    public function liste() {
        
        
        // récupérer la liste des utilisateur
        // besoin du UserManager
        $userManager = new UserManager();
        $users = $userManager->selectAll();

        
        // var_dump($users); 
        // die();
        
        require './views/private.phtml';
    }
    
    
}
        
   

?>