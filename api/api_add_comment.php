<?php
    include_once("../includes/session.php");
    include_once("../database/comments.php");
    include_once("../database/users.php");

    if($_SESSION['csrf'] !== $_POST['csrf']) {
        echo json_encode([]);
        die();
    }

    $comment = $_POST['comment'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    $userId = $_POST['userId'];
    $petId = $_POST['petId'];
    $proposeId = $_POST['proposeId'];

    addComment($comment, $date, $hour, $userId, $petId, $proposeId);

    echo json_encode([$comment, $date, $hour, $proposeId, getUserById($userId)['username'], $userId]);
?>