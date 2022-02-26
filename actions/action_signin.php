<?php
    include_once("../includes/session.php");
    include_once('../database/users.php');
    include_once("../xss/valid_inputs.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    if($_SESSION['csrf'] !== $_POST['csrf']){
        createErrorMessage("Invalid token!");
        die(header("Location: ../pages/signin.php"));
    }

    if (validUsername($_POST['username']) && validPassword($_POST['password'])) {
        if(verifyUser($_POST['username'], $_POST['password'])) {
            $user = getUserByUsername($_POST['username']);
            $_SESSION['userId'] = $user['id'];
            createSucessMessage("Welcome back ".$user['name']."!");
            header('Location: ../pages/home.php');
        }
        else{
            createErrorMessage("Invalid Username or Password!");
            header('Location: ../pages/signin.php');
        }
    }
    else
        header('Location: ../pages/signin.php');
?>