<?php
    include_once("connection.php");

    function getFavoritePets($userId) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM favoritepets WHERE favoritepets.userId = ?');
        $stmt->execute(array($userId));

        return $stmt->fetchAll();
    }

    function removeFromFavoritePets($petid, $userId){
        global $db;
        $stmt = $db->prepare('DELETE from favoritePets where petId = ? and userId = ?');
        if($stmt->execute(array($petid, $userId))) createSucessMessage("Pet successfully remove from your favorite list!");
        else createErrorMessage("We could not remove this pet from your favorite list right now!");
    }
?>