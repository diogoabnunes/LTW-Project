<?php
    include_once("connection.php");

    function getComments($petId){
        global $db;

        $stmt = $db->prepare('SELECT * FROM Comment WHERE petId = ?');
        $stmt->execute(array($petId));

        return $stmt->fetchAll();
    }


    function setComments(){
        global $db;
        if(isset($_POST['commmentSubmit'])){
            $userId = $_POST['userId'];
            $comment_date = $_POST['comment_date'];
            $comment_hour = $_POST['comment_hour'];
            $comment = $_POST['comment'];
            $pet_id = $_POST['petId'];

            $db->exec("INSERT INTO Comment (comment, comment_date, comment_hour, userId, petId) VALUES ('$comment', '$comment_date', '$comment_hour', '$userId', '$pet_id');");
        }

    }

    function getPropose($petId){
        global $db;

        $stmt = $db->prepare('SELECT * FROM Propose WHERE petId = ?');
        $stmt->execute(array($petId));

        return $stmt->fetchAll();
    }

    function setPropose(){
        global $db;
        if(isset($_POST['ProposeSubmit'])){
            $userId = $_POST['userId'];
            $state = "processing";
            $description = $_POST['description'];
            $pet_id = $_POST['petId'];

            $db->exec("INSERT INTO Propose (description, state, userId, petId) VALUES ('$description', '$state', '$userId', '$pet_id');");
        }
    }

    function getSpeciesN($petId){
        global $db;

        $stmt = $db->prepare('SELECT * FROM Pet, Species WHERE Pet.speciesId = Species.id AND Pet.id = ?');
        $stmt->execute(array($petId));

        return $stmt->fetch();
    }


    function addPetToFavorites($petid, $userId){
        global $db;
        $stmt = $db->prepare('INSERT INTO FavoritePets VALUES(?, ?);');
        if($stmt->execute(array($userId, $petid))) createSucessMessage("Pet successfully added to your favorite list!");
        else createErrorMessage("We could not add this pet to your favorite list right now!");
    }


    function isPetFavorite($petId, $userId){
        global $db;

        $stmt = $db->prepare('SELECT count(*) from favoritePets where petId = ? and userId = ?');
        $stmt->execute(array($petId, $userId));
        $temp = $stmt->fetch();
        $number = intval($temp['count(*)']);
        if($number > 0){
            return true;
        } else {
            return false;
        }
    }

?>