<?php
    include_once("../includes/session.php");
    include_once("../database/pet_info.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    if($_SESSION['csrf'] !== $_POST['csrf']) {
        createErrorMessage("Invalid token!");
        die(header("Location: ../pages/pet_info.php"));
    }

    addPetToFavorites($_POST['petId'],$_POST['userId']);

    header('Location: ../pages/pet_info.php');
?>