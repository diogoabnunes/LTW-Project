<?php
    include_once("../includes/session.php");
    include_once("../database/pets.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    $photoId = $_GET['ph'];
    $petId = $_GET['p'];
    $photos = getPetPhotosById($petId);
    $photosR = array_reverse($photos);
    $newPhotoId = $photoId;
    foreach($photosR as $photo){
        if($photo['id'] < $photoId){
            
            $newPhotoId = $photo['id'];
            break;
        }
    }
    $numNewPhotoId = intval($newPhotoId);
    $newPhoto = getPetPhotoByPhotoId($numNewPhotoId);

    ?>
    <form method='post'>
    <input id = "next" type="button" value="<<" onclick="previousPhoto(<?=$petId?>,<?=$numNewPhotoId?>)">
    </form>

    <img src=<?=$newPhoto['img']?> width="200" height="200">

    <form method='post'>
    <input id = "next" type="button" value=">>" onclick="nextPhoto(<?=$petId?>,<?=$numNewPhotoId?>)">
    </form>
    <?php

    

    
?>