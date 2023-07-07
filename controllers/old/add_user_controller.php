<?php

// require './models/user_model.php';
require_once './models/User.php';
require_once './models/UserManager.php';
    

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
        
        $_SESSION['id'] = $userManager->insert($user);
        
        $_SESSION['login'] = $user->getLogin();

        header('Location: index.php?page=home&register=ok');
        
    }
    
            
}


require './views/add_user.phtml';

