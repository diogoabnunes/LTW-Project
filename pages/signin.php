<?php
    include_once("../includes/session.php");
    include_once("../auxiliar/messages.php");

    // if the user is already logged in goes to the home
    if (isset($_SESSION['userId']))
        die(header('Location: home.php'));

    include_once("../templates/tpl_header.php");
    getHeader("Friends For Life - Signin");
    include_once("../templates/tpl_messages.php");
    include_once("../templates/tpl_signin.php");
    include_once("../templates/tpl_footer.php");
?>