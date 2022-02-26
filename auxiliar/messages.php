<?php
    
    function clearMessages() {
        $_SESSION['errorMessage'] = "";
        $_SESSION['sucessMessage'] = "";
    }

    function createErrorMessage($message) {
        $_SESSION['errorMessage'] = $message;
        $_SESSION['sucessMessage'] = "";
    }

    function createSucessMessage($message) {
        $_SESSION['sucessMessage'] = $message;
        $_SESSION['errorMessage'] = "";
    }
?>