<?php
    include_once("../includes/session.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    if($_SESSION['userId'] === $_GET['id']) header('Location: ../pages/my_page.php');
    else{
        $_SESSION['userPageId'] = $_GET['id'];
        header('Location: ../pages/user_page.php');
    }
?>