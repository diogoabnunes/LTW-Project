<?php
    include_once("connection.php");
    include_once("users.php");

    function getAdoptedPets($userId) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM pet NATURAL JOIN adoption WHERE pet.id = adoption.petId AND adoption.userId = ?');
        $stmt->execute(array($userId));

        return $stmt->fetchAll();
    }

    function getUserAdoptedPet($petId) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM adoption WHERE petId = ?');
        $stmt->execute(array($petId));

        return getUserById($stmt->fetch()['userId']);
    }

    function addAdoptedPet($userId, $petId){
        global $db;

        $stmt = $db->prepare('INSERT INTO adoption VALUES(?, ?)');
        $stmt->execute(array($userId, $petId));
    }

?>