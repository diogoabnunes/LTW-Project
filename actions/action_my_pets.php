<?php
    include_once("../includes/session.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    header('Location: ../pages/my_pets.php');
?>