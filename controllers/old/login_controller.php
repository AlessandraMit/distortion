<?php 

// require './models/user_model.php';
require_once './models/User.php';
require_once './models/UserManager.php';



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

?>