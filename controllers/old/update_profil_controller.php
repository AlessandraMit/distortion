<?php 

require './models/user_model.php';


if(!empty($_POST)) {
    
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
        // var_dump($_FILES['file']['name']);
        $file = $_FILES['file']['name'];
    } elseif(isset($_SESSION['avatar']) && $_SESSION['avatar'] != null) {
        $file = $_SESSION['avatar'];
    } else {
        $file = null;
    }
    
    updateUser($_SESSION['id'], $_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['login'], $file);
    
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'.$_FILES['file']['name']);
    
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['avatar'] = $_FILE['file']['name'];
    
}

$user = getUserById($_SESSION['id']);

require'./views/profil.phtml';


?>