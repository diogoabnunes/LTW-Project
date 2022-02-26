<?php
    include_once("../database/pets.php");

    $species = $_POST['species'];
    $breeds = $_POST['breeds'];
    $genders = $_POST['genders'];
    $states = $_POST['states'];

    $pets = getAllPetsAndTheirPhotos();

    $speciesFiltered = array();
    $breedsFiltered = array();
    $gendersFiltered = array();
    $statesFiltered = array();

    if(strlen($species) === 0) $speciesFiltered = $pets;
    else $speciesFiltered = filterSpecies($pets, $species);

    if(strlen($breeds) === 0) $breedsFiltered = $speciesFiltered;
    else $breedsFiltered = filterBreeds($speciesFiltered, $breeds);

    if(strlen($genders) === 0) $gendersFiltered = $breedsFiltered;
    else $gendersFiltered = filterGenders($breedsFiltered, $genders);

    if(strlen($states) === 0) $statesFiltered = $gendersFiltered;
    else $statesFiltered = filterStates($gendersFiltered, $states);

    echo json_encode($statesFiltered);

    function filterSpecies($pets, $species) {
        $speciesArray = explode(',', $species);
        $ret = array();

        foreach($speciesArray as $specieFilter) {
            foreach($pets as $pet) {
                if($pet['species'] === $specieFilter) $ret[] = $pet;
            }
        }

        return $ret;
    }

    function filterBreeds($pets, $breeds) {
        $breedsArray = explode(',', $breeds);
        $ret = array();

        foreach($breedsArray as $breedFilter) {
            foreach($pets as $pet) {
                if($pet['breed'] === $breedFilter) $ret[] = $pet;
            }
        }

        return $ret;
    }

    function filterGenders($pets, $genders) {
        $gendersArray = explode(',', $genders);
        $ret = array();

        foreach($gendersArray as $genderFilter) {
            foreach($pets as $pet) {
                if($pet['gender'] === $genderFilter) $ret[] = $pet;
            }
        }

        return $ret;
    }

    function filterStates($pets, $states) {
        $statesArray = explode(',', $states);
        $ret = array();

        foreach($statesArray as $stateFilter) {
            foreach($pets as $pet) {
                if($pet['state'] === $stateFilter) $ret[] = $pet;
            }
        }

        return $ret;
    }
?>