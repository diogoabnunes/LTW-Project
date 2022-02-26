<?php
    include_once("../includes/session.php");
    include_once("../auxiliar/messages.php");

    // if the user is not logged in goes to the signin
    if (!isset($_SESSION['userId']))
        die(header('Location: signin.php'));

    include_once('../templates/tpl_header.php');
    getHeader("Add a Pet");
    include_once("../templates/tpl_messages.php");
    include_once('../templates/tpl_add_pet.php');
    include_once('../templates/tpl_footer.php');
?>