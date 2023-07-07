<?php

require './models/user_model.php';
// aller chercher les infos de l'utilisateur connecté : getUserById()


// var_dump($user);
// $_FILES : contient les fichiers envoyés par un formulaire

// move_uploaded_file()

if(!empty($_POST)) {
    
    // var_dump($_FILES['file']);
    // die();
    
    // var_dump($_FILES);
    
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
        // var_dump($_FILES['file']['name']);
        $file = $_FILES['file']['name'];
    } elseif(isset($_SESSION['avatar']) && $_SESSION['avatar'] != null) {
        $file = $_SESSION['avatar'];
    } else {
        $file = null;
    }
    
    updateUser($_SESSION['id'], $_POST['login'], $_POST['email'], $_POST['first-name'], $_POST['last-name'], $_POST['birthdate'], $file);
    
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'.$_FILES['file']['name']);
    
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['avatar'] = $file;
    
    // var_dump($_SESSION);
}

$user = getUserById($_SESSION['id']);

require './views/profil.phtml';

?>