<?php
    include_once("../includes/session.php");
    include_once("../database/proposes.php");
    include_once("../database/users.php");

    if($_SESSION['csrf'] !== $_POST['csrf']) {
        echo json_encode([]);
        die();
    }
    
    $propose = $_POST['propose'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    $userId = $_POST['userId'];
    $petId = $_POST['petId'];

    addPropose($propose, $date, $hour, $userId, $petId);
    $proposes = getProposes();
    $lastPropose = $proposes[count($proposes) - 1];
    $user = array();
    $user['userId'] = $userId;
    $user['username'] = getUserById($userId)['username'];

    echo json_encode(array_merge($lastPropose, $user));
?>