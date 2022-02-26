<?php
    include_once("connection.php");

    function addComment($comment, $date, $hour, $userId, $petId, $proposeId) {
        global $db;

        if($proposeId === "null") $proposeId = NULL;

        $stmt = $db->prepare('INSERT INTO comment VALUES(NULL, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($comment, $date, $hour, $userId, $petId, $proposeId));
    }

?>