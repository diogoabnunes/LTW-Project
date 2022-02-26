<?php
    include_once("../includes/session.php");
    include_once("../database/favorite_pets.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    if($_SESSION['csrf'] !== $_POST['csrf']) {
        createErrorMessage("Invalid token!");
        die(header("Location: ../pages/favorite_pets.php"));
    }

    removeFromFavoritePets($_POST['petId'],$_POST['userId']);

    header('Location: ../pages/favorite_pets.php');
?>