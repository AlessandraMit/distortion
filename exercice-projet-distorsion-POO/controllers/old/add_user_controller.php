<?php

require './models/user_model.php';

// si on soumet le formulaire
if(!empty($_POST)){
    
    $errors = [];
    
    foreach($_POST as $key => $data) {
        // echo $key."<br>";
        // echo $data."<br>";
        
        if($data === '') {
            $errors[$key] = 'Le champ '.$key.' ne doit pas être vide.';
        }
    }
    
    // verif sur tous les champs obligatoire
    
    // si tous les champs sont ok -> insertion dans la BDD -> createUser(parametres)
    if(count($errors) === 0) {
        
        $_SESSION['id'] = createUser($_POST['login'], $_POST['password'], $_POST['email'], $_POST['first-name'], $_POST['last-name'], $_POST['birthdate']);
        
        $_SESSION['login'] = $_POST['login'];

        header('Location: index.php?page=home&register=ok');
    }
    
    // sinon -> affichage des messages d'erreurs
}

require './views/add_user.phtml';
?>