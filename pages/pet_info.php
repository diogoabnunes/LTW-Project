<?php
    include_once("../includes/session.php");
    include_once("../database/pets.php");
    include_once("../auxiliar/messages.php");

    // if the user is not logged in goes to the signin
    if (!isset($_SESSION['userId']))
        die(header('Location: signin.php'));

    $pet_info = getPetById($_SESSION['petId']); 

    $header = "Pet Page - ".$pet_info['petname']."'s Page";

    include_once('../templates/tpl_header.php');
    getHeader($header);
    include_once("../templates/tpl_messages.php");
    include_once('../templates/tpl_pet_info.php');
    include_once('../templates/tpl_footer.php');
    
?>
