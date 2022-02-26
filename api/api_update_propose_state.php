<?php
    include_once("../includes/session.php");
    include_once("../database/users.php");
    include_once("../database/pets.php");
    include_once("../database/proposes.php");
    include_once("../database/adopted_pets.php");

    if($_SESSION['csrf'] !== $_POST['csrf']) {
        echo json_encode([]);
        die();
    }
    
    $user = getUserByUsername($_POST['username']);
    $petId = $_POST['petId'];
    $proposeId = $_POST['proposeId'];
    $value = $_POST['value'];

    updateProposeState($proposeId, $value);

    if($value === "accepted") {
        updatePetState($petId, "adopted");
        addAdoptedPet($user['id'], $petId);

        // reject all the remaing proposes
        $proposes = getProposes();
        foreach($proposes as $propose) {
            if($propose['id'] !== $proposeId)
                updateProposeState($propose['id'], "rejected");
        }
    }

    echo json_encode([$proposeId, $value, $user['username']]);
?>