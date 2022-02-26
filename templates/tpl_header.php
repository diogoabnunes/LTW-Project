<?php
    function getHeader($title) { ?>
        <!DOCTYPE html>

        <html>
            <head>
                <meta charset='utf-8'/>
                <title> <?=$title?> </title>
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
                <link rel="stylesheet" href="../css/style_common.css">
                <link rel="stylesheet" href="../css/style_auth.css">
                <link rel="stylesheet" href="../css/style_home.css">
                <link rel="stylesheet" href="../css/style_my_page.css">
                <link rel="stylesheet" href="../css/style_favorite_pets.css">
                <link rel="stylesheet" href="../css/style_my_pets.css">
                <link rel="stylesheet" href="../css/style_adopted_pets.css">
                <link rel="stylesheet" href="../css/style_pet_info.css">
                <link rel="stylesheet" href="../css/style_add_pet.css">
                <link rel="stylesheet" href="../css/style_user_page.css">
                <script src="../js/my_page.js" defer></script>
                <script src="../js/dates.js" defer></script>
                <script src="../js/home.js" defer></script>
                <script src="../js/add_pet.js" defer></script>
                <script src="../js/pet_info.js" defer></script>
                <script src="../js/messages.js" defer></script>
            </head>
            <body>
                <header>
                    <h1> <a href = "../actions/action_home.php"> Friends For Life </a></h1>
                </header>
    <?php } 
?>
