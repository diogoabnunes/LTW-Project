<?php
    include_once("connection.php");

    function getUserById($userId) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->execute(array($userId));

        return $stmt->fetch();
    }

    function getUserByUsername($username) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
        $stmt->execute(array($username));

        return $stmt->fetch();
    }

    function getUserPhoto($userId) {
        global $db;

        $stmt = $db->prepare('SELECT img FROM photos WHERE userId = ?');
        $stmt->execute(array($userId));

        return $stmt->fetch();
    }

    function getUserAddedPet($petId) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM MyPets WHERE petId = ?');
        $stmt->execute(array($petId));

        $userId = $stmt->fetch()['userId'];

        $user_info = getUserById($userId);
        
        return $user_info;
    }

    function verifyUser($username, $password) {
        $user_info = getUserByUsername($username);

        if($user_info && 
           $user_info['username'] == $username && 
           password_verify($password, $user_info['password']))
            return true;
        else return false;
    }

    function verifyNewUser($username) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
        $stmt->execute(array($username));

        return count($stmt->fetchAll());
    }

    function deleteUser($userId) {
        global $db;

        $stmt = $db->prepare('DELETE FROM user WHERE id = ?');
        return $stmt->execute(array($userId));
    }

    function addUser($photo, $name, $birthDate, $gender, $location, $username, $password) {
        global $db;

        if(getUserByUsername($username)) {
            createErrorMessage("The Username: ".$username." already exists!");
            return false;
        }

        if($location === "") $location = NULL;

        $options = ['cost' => 12];
        $stmt = $db->prepare('INSERT INTO user VALUES(NULL, ?, ?, ?, ?, ?, ?)');
        if(!$stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT, $options), $name, $birthDate, $gender, $location))) {
            createErrorMessage("Something went wrong while we were saving your info!");
            return false;
        }

        $userId = getUserByUsername($username)['id'];

        if($photo === NULL || $photo['name'] === ""){ // inserts a has no photo
            $stmt = $db->prepare('INSERT INTO photos VALUES(NULL, ?, NULL, ?)');
            if($stmt->execute(array("../assets/images/user/no-user-image.png", $userId))) return true;
            else {
                deleteUser($userId);
                createErrorMessage("Something went wrong while we were saving your info!");
                return false;
            }
        }
        else {
            if(save_new_photo($userId, $photo)) return true;
            else {
                deleteUser($userId);
                createErrorMessage("Something went wrong while we were saving your info!");
                return false;
            }
        }
    }

    function save_new_photo($user, $photo) {
        if($photo === NULL || $photo['name'] === "") {
            createErrorMessage("No photo was selected!");
            return false; // no photo was selected
        }

        $photo_name = $photo['name'];
        $photo_tmp_name = $photo['tmp_name'];
        $photo_size = $photo['size'];
        $photo_error = $photo['error'];
    
        if($photo_error !== 0) {
            createErrorMessage("Something went wrong while we were saving your info1!");
            return false; // there was an error uploading the photo
        }

        $photo_name_splited = explode('.', $photo_name);
        $photo_extension = strtolower(end($photo_name_splited)); // gets the photo extension
        $new_photo_name = uniqid('', true).".".$photo_extension; // gets a new name bases on the current time
        $photo_destination = "../assets/images/user/".$new_photo_name;

        move_uploaded_file($photo_tmp_name, $photo_destination);

        global $db;

        // removes the old photo from the database
        $stmt = $db->prepare('DELETE FROM photos WHERE userId=?');
        $stmt->execute(array($user));

        // inserts the new photo in the database
        $stmt = $db->prepare('INSERT INTO photos VALUES(NULL, ?, NULL, ?)');
        if($stmt->execute(array($photo_destination, $user))) {
            createSucessMessage("Photo successfully updated!");
            return true;
        }
        else {
            createErrorMessage("Something went wrong while we were saving your info!");
            return false;
        }
    }

    function save_new_username($user, $new_username) {
        if($new_username === "") return; // the new_username can't be empty

        $user_aux = getUserByUsername($new_username); // necessary to verify if there is already a user with this username

        if($user_aux) {
            createErrorMessage("The Username: ".$new_username." already exists!");
            return; // there is already a user registered with that user_name
        }

        global $db;

        $stmt = $db->prepare('UPDATE user SET username=? WHERE id=?');
        $stmt->execute(array($new_username, $user));

        createSucessMessage("Username successfully updated!");

        // $_SESSION['username'] = $new_username;
    }

    function save_new_password($user, $old_password, $new_password) {
        if($new_password === "") return; // the new_password can't be empty

        $user_info = getUserById($user);

        if(!password_verify($old_password, $user_info['password'])) {
            createErrorMessage("Invalid Current Password!");
            return; // the old password doesn't match the current user password
        }
    
        global $db;

        $options = ['cost' => 12];
        $stmt = $db->prepare('UPDATE user SET password=? WHERE id=?');
        $stmt->execute(array(password_hash($new_password, PASSWORD_DEFAULT, $options), $user));

        createSucessMessage("Password successfully updated!");
    }

    function save_new_name($user, $new_name) {
        if($new_name === "") return; // the new_name can't be empty

        global $db;

        $stmt = $db->prepare('UPDATE user SET name=? WHERE id=?');
        $stmt->execute(array($new_name, $user));

        createSucessMessage("Name successfully updated!");
    }

    function save_new_birth_date($user, $new_birth_date) {
        if($new_birth_date === "") return; // the new_birth_date can't be empty

        global $db;

        $stmt = $db->prepare('UPDATE user SET birth_date=? WHERE id=?');
        $stmt->execute(array($new_birth_date, $user));

        createSucessMessage("Birth date successfully updated!");
    }

    function save_new_gender($user, $new_gender) {
        if($new_gender === "") return; // the new_gender can't be empty

        global $db;

        $stmt = $db->prepare('UPDATE user SET gender=? WHERE id=?');
        $stmt->execute(array($new_gender, $user));

        createSucessMessage("Gender successfully updated!");
    }

    function save_new_location($user, $new_location) {
        if($new_location === "") $new_location = NULL;

        global $db;

        $stmt = $db->prepare('UPDATE user SET location=? WHERE id=?');
        $stmt->execute(array($new_location, $user));

        createSucessMessage("Location successfully updated!");
    }
?>