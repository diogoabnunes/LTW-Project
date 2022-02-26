<?php 

    displayErrorMessage();
    displaySucessMessage();

    function displayErrorMessage() {
        if(!isset($_SESSION['errorMessage']) || $_SESSION['errorMessage'] === "") return;

        ?> <div id="errorMessage"> <div class="closeIcon"> <i class="fas fa-times"></i> </div> <p> <?=$_SESSION['errorMessage']?> </p> </div> <?php
    }

    function displaySucessMessage() {
        if(!isset($_SESSION['sucessMessage']) || $_SESSION['sucessMessage'] === "") return;

        ?> <div id="sucessMessage"> <div class="closeIcon"> <i class="fas fa-times"></i> </div> <p> <?=$_SESSION['sucessMessage']?> </p> </div> <?php
    }
    
?>
