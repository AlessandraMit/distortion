<?php 

require './models/user_model.php';

if($_GET['page'] === 'logout') {
    
    session_destroy();
    
    header('Location: index.php');
    
}

if(!empty($_POST)) {
    
    $user = getUser($_POST['login'], $_POST['password']);
    
    if(!$user) {
        $error = 'Identifiants incorrects';
    } else {
        
        // var_dump($_POST);
        // die();
        // var_dump($user);
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['avatar'] = $user['file'];
        
        // if(isset($_POST['connect'])) {
            
        //     setcookie('id', $user['id'], 86400 * 7);
        //     setcookie('login', $user['login'], 86400 * 7);
        // }
        
        header('Location: index.php');
    }
    
}

require './views/login.phtml';

?>