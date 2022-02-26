<?php
    include_once("../includes/session.php");
    include_once("../database/pets.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    $specieName = $_GET['s'];

    $breeds = getBreedsBySpecie($specieName);
    $i = 0;
    foreach($breeds as $breed){
        $actualBreeds[$i] = $breed['breed'];
        $i = $i + 1;
    }
    ?> <option></option> <?php
    foreach($actualBreeds as $breed){?>
        
            <option><?=$breed?></option>
        <?php }

?>


