<?php
    include_once("../includes/session.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    $_SESSION['petId'] = $_GET['id'];

    header('Location: ../pages/pet_info.php');
?>