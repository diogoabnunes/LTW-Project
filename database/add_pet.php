<?php
    include_once("connection.php");

    function deletePet($petId) {
        global $db;

        $stmt = $db->prepare('DELETE FROM pet WHERE id = ?');
        return $stmt->execute(array($petId));
    }

    function deletePetPhoto($petId) {
        global $db;

        $stmt = $db->prepare('DELETE FROM Photos WHERE petId = ?');
        return $stmt->execute(array($petId));
    }

    function addPet($name,$description,$speciesId,$gender,$colour,$bday,$location,$image,$userId) {
        global $db;

        $stmt = $db->prepare('INSERT INTO Pet VALUES(NULL,?,?,?,?,?,?,?,"not adopted")');
        $stmt->execute(array($name,$description,$speciesId,$gender,$colour,$bday,$location));
        $petId = $db->lastInsertId();

        if(save_pet_photo($userId,$petId,$image)) {
            if(addPetToMyPets($petId, $userId)) {
                createSucessMessage("Pet successfully added!");
                return true;
            }
            else {
                deletePetPhoto($petId);
                deletePet($petId);
                createErrorMessage("Something went wrong while we were saving pet info!");
                return false;
            }
        }
        else {
            deletePet($petId);
            createErrorMessage("Something went wrong while we were saving pet info!");
            return false;
        }

        return;
    }


    function save_pet_photo($userId, $petId, $photo) {
        if($photo === NULL || $photo['name'] === "") {
            createErrorMessage("No photo was selected!");
            return false; // no photo was selected
        }

        $photo_name = $photo['name'];
        $photo_tmp_name = $photo['tmp_name'];
        $photo_size = $photo['size'];
        $photo_error = $photo['error'];
    
        if($photo_error !== 0) {
            createErrorMessage("Something went wrong while we were saving pet info!");
            return false; // there was an error uploading the photo
        }

        $photo_name_splited = explode('.', $photo_name);
        $photo_extension = strtolower(end($photo_name_splited)); // gets the photo extension
        $new_photo_name = uniqid('', true).".".$photo_extension; // gets a new name bases on the current time
        $photo_destination = "../assets/images/pets/".$new_photo_name;

        move_uploaded_file($photo_tmp_name, $photo_destination);

        global $db;

        // inserts the new photo in the database
        $stmt = $db->prepare('INSERT INTO photos VALUES(NULL, ?, ?, NULL)');
        if($stmt->execute(array($photo_destination, $petId))) {
            createSucessMessage("Photo successfully added!");
            return true;
        }   
        else {
            createErrorMessage("Something went wrong while we were saving pet info!");
            return false;
        }
    }

    function addPetToMyPets($petId, $userId) {
        global $db;

        $stmt = $db->prepare('INSERT INTO MyPets VALUES(?, ?)');
        return $stmt->execute(array($userId, $petId));        
    }

?>