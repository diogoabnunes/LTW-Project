<?php
    include_once("../includes/session.php");
    include_once("../database/add_pet.php");
    include_once("../database/pets.php");
    include_once("../xss/valid_inputs.php");
    include_once("../auxiliar/messages.php");

    clearMessages();

    if($_SESSION['csrf'] !== $_POST['csrf']) {
        createErrorMessage("Invalid token!");
        die(header("Location: ../pages/add_pet.php"));
    }

    if(!(validName($_POST['name']) && 
         validLocation($_POST['location']) && 
         validDescription($_POST['description'])))
        die(header('Location: ../pages/add_pet.php'));

    if($_SESSION['csrf'] !== $_POST['csrf']) {
        createErrorMessage("Invalid token!");
        die(header("Location: ../pages/home.php"));
    }

    $userId = $_SESSION['userId'];

    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $bday = $_POST['bday'];
    $gender = $_POST['gender'];
    $colour = $_POST['colour'];
    $location = $_POST['location'];
    $image = $_FILES['image'];
    $description = $_POST['description'];

    $speciesId = getSpeciesIdBySpeciesAndBreed($species,$breed);


    addPet($name,$description,$speciesId['id'],$gender,$colour,$bday,$location,$image,$userId);

    header('Location: ../pages/home.php');
?>