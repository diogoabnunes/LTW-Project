<?php
    include_once("../includes/session.php");
    include_once("../database/users.php");
    include_once("../auxiliar/messages.php");

    // if the user is not logged in goes to the signin
    if (!isset($_SESSION['userId']))
        die(header('Location: signin.php'));

    $user_info=getUserById($_SESSION['userId']);
    $header = "My Page - ".$user_info['username'];

    include_once('../templates/tpl_header.php');
    getHeader($header);
    include_once("../templates/tpl_messages.php");
    include_once('../templates/tpl_my_page.php');
    include_once('../templates/tpl_footer.php');
?>
