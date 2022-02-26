<?php
    include_once("connection.php");

    function updateProposeState($proposeId, $state) {
        global $db;

        $stmt = $db->prepare('UPDATE propose SET state=? WHERE id=?');
        $stmt->execute(array($state, $proposeId));
    }

    function addPropose($propose, $date, $hour, $userId, $petId) {
        global $db;

        $stmt = $db->prepare('INSERT INTO propose VALUES(NULL, ?, ?, ?, "processing", ?, ?)');
        $stmt->execute(array($propose, $date, $hour, $userId, $petId));
    
    }

    function getProposes() {
        global $db;

        $stmt = $db->prepare('SELECT * FROM propose');
        $stmt->execute(array());

        return $stmt->fetchAll();
    }

?>