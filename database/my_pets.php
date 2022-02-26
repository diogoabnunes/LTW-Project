<?php
    include_once("connection.php");

    function getMyPets($userId) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM mypets WHERE mypets.userId = ?');
        $stmt->execute(array($userId));

        return $stmt->fetchAll();
    }
?>