<?php
    include_once("../includes/session.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    header('Location: ../pages/favorite_pets.php');
?>