<?php
    include_once("../includes/session.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    if($_SESSION['csrf'] !== $_GET['csrf']) {
        createErrorMessage("Invalid token!");
        die(header("Location: ../pages/home.php"));
    }

    session_destroy();

    header('Location: ../pages/signin.php');
?>