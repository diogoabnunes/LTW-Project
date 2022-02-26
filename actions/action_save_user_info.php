<?php
    include_once("../includes/session.php");
    include_once("../database/users.php");
    include_once("../xss/valid_inputs.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    if($_SESSION['csrf'] !== $_POST['csrf']) {
        createErrorMessage("Invalid token!");
        die(header("Location: ../pages/home.php"));
    }

    if($_POST['topic'] === 'user-photo') save_new_photo($_SESSION['userId'], $_FILES['photo']);

    else if($_POST['topic'] === 'username')  {
        if (validUsername($_POST['username']))
            save_new_username($_SESSION['userId'], $_POST['username']);
    }

    else if($_POST['topic'] === 'password') {
        if (validPassword($_POST['new_password']))
            save_new_password($_SESSION['userId'], $_POST['old_password'], $_POST['new_password']);
    }

    else if($_POST['topic'] === 'name'){
        if(validName($_POST['name']))
            save_new_name($_SESSION['userId'], $_POST['name']);
    }

    else if($_POST['topic'] === 'birth_date') save_new_birth_date($_SESSION['userId'], $_POST['birth_date']);

    else if($_POST['topic'] === 'gender') save_new_gender($_SESSION['userId'], $_POST['gender']);
    
    else {
        if(validLocation($_POST['location'])) {
            if (validLocation($_POST['location']))
                save_new_location($_SESSION['userId'], $_POST['location']);
        }
    }

    header('Location: ../pages/my_page.php');
?>