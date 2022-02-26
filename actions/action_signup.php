<?php
    include_once("../includes/session.php");
    include_once('../database/users.php');
    include_once("../xss/valid_inputs.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    if($_SESSION['csrf'] !== $_POST['csrf']) {
        createErrorMessage("Invalid token!");
        die(header("Location: ../pages/signup.php"));
    }

    if(!(validName($_POST['name']) && validLocation($_POST['location']) && validUsername($_POST['username']) && validPassword($_POST['password'])))
        die(header('Location: ../pages/signup.php'));

    if(addUser($_FILES['photo'], $_POST['name'], $_POST['birthDate'], $_POST['gender'], $_POST['location'], $_POST['username'], $_POST['password'])) {
        $_SESSION['userId'] = getUserByUsername($_POST['username'])['id'];
        createSucessMessage("Your account was registred with sucess! Welcome ".$_POST['name']."!");
        header('Location: ../pages/home.php');
    }
    else header('Location: ../pages/signup.php');
?>