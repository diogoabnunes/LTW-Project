<?php
    include_once("connection.php");

    function getAllPets() {
        global $db;
        $stmt = $db->prepare('SELECT pet.id, petname, gender, color, birth_date, state, species, breed FROM pet, species WHERE pet.speciesId = species.id');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function getPetById($id){
        global $db;
        $stmt = $db->prepare('SELECT * FROM pet WHERE pet.id = ?');
        $stmt->execute(array($id));

        return $stmt->fetch();
    }

    function getBreeds() {
        global $db;

        $stmt = $db->prepare('SELECT DISTINCT breed FROM species');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function getSpecies() {
        global $db;

        $stmt = $db->prepare('SELECT DISTINCT species FROM species');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function getPetPhotoById($petId){
        global $db;
        $stmt = $db->prepare('SELECT * from Photos where Photos.petId = ?');
        $stmt->execute(array($petId));

        return $stmt->fetch();
    }

    function getPetPhotosById($petId){
        global $db;
        $stmt = $db->prepare('SELECT * from Photos where Photos.petId = ?');
        $stmt->execute(array($petId));

        return $stmt->fetchAll();
    }

    function getPetPhotoByPhotoId($photoId){
        global $db;
        $stmt = $db->prepare('SELECT * from Photos where id = ?');
        $stmt->execute(array($photoId));

        return $stmt->fetch();
    }

    function getAllPetsAndTheirPhotos() {
        global $db;
        $stmt = $db->prepare('SELECT pet.id, petname, gender, color, birth_date, state, species, breed FROM pet, species WHERE pet.speciesId = species.id');
        $stmt->execute();

        $allPets = $stmt->fetchAll();
        $newPets = array();
        foreach($allPets as $pet){
            $photo = getPetPhotoById($pet['id']);
            $pet['img'] = $photo['img'];
            array_push($newPets,$pet);
        }
        return $newPets;
    }

    function getBreedsBySpecie($specieName) {
        global $db;

        $stmt = $db->prepare('SELECT breed from species where species.species like ?');
        $stmt->execute(array($specieName));

        return $stmt->fetchAll();
    }

    function getSpeciesIdBySpeciesAndBreed($specieName,$breedName){
        global $db;

        $stmt = $db->prepare('SELECT id from species where species.species like ? and species.breed like ?');
        $stmt->execute(array($specieName,$breedName));

        return $stmt->fetch();
    }
    
    function updatePetState($petId, $state) {
        global $db;

        $stmt = $db->prepare('UPDATE pet SET state=? WHERE id=?');
        $stmt->execute(array($state, $petId));
    }
?>