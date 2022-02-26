<?php
    include_once("../includes/session.php");
    include_once("../database/add_pet.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    if($_SESSION['csrf'] !== $_POST['csrf']) {
        createErrorMessage("Invalid token!");
        die(header("Location: ../pages/pet_info.php"));
    }

    $userId = $_SESSION['userId'];
    $image = $_FILES['image'];
    $petId = $_POST['petId'];

    save_pet_photo($userId,$petId,$image);

    header('Location: ../pages/pet_info.php');
?>