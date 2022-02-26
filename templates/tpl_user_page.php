<?php
    include_once("../database/users.php");
    include_once("../database/pets.php");
    include_once("../database/my_pets.php");

    $current_user = getUserById($_SESSION['userId']);;
    $user_info=getUserById($_SESSION['userPageId']);
    $photo=getUserPhoto($_SESSION['userPageId'])['img'];
    $my_pets=getMyPets($_SESSION['userPageId']);
    function getGender() {
        global $user_info;
        $gender = $user_info['gender'];

        if($gender === 'M') return 'Male';
        else return 'Female';
    }

?>

<div class="user_options">
    <a href="../actions/action_user_page.php?id=<?=$_SESSION['userId']?>"> <?=$current_user['username']?> </a> 
    <a href="../actions/action_signout.php?csrf=<?=$_SESSION['csrf']?>"> Signout </a>
</div>
<nav class="nav">
    <ul>
        <li> <a href="../actions/action_user_page.php?id=<?=$_SESSION['userPageId']?>"> <?=$user_info['username']?>'s Page </a> </li>
    </ul>
</nav>
<section id="user_page_body">
    <section id="user_info_">
        <div>
                <input type="text" name="topic" value="user-photo" hidden>
                <img src=<?=$photo?> alt="User Photo" width="200" height="200">
        </div>
        <div>
                <input type="text" name="topic" value="username" hidden>
                <span class="topics"> Username: </span> <span class="info_topics"> <?= $user_info['username'] ?> </span>
        </div>
        <div>
                <input type="text" name="topic" value="name" hidden>
                <span class="topics"> Name: </span> <span class="info_topics"> <?= $user_info['name'] ?> </span>
        </div>
        <div>
                <input type="text" name="topic" value="birth_date" hidden>
                <span class="topics"> Birth Date: </span> <span class="info_topics"> <?= $user_info['birth_date'] ?> </span>
         </div>
            <div>
                    <input type="text" name="topic" value="gender" hidden>
                    <span class="topics"> Gender: </span> <span class="info_topics"> <?=getGender()?> </span> 
            </div>
        <div>
                <input type="text" name="topic" value="location" hidden>
                <span class="topics"> Location: </span> <span class="info_topics"> <?= $user_info['location'] ?> </span>
        </div>
    </section>
    <section id="user_pets">
            <p id="title"> <?= $user_info['name'] ?>'s Pets </p>
            <div>
            <?php
                foreach($my_pets as $my_pet){ 
                    $pet = getPetById($my_pet['petId']);
                    $petPhoto = getPetPhotoById($my_pet['petId']);
                    ?>
                    <article class="user_pets">
                        <a href="../actions/action_pet_info.php?id=<?php echo $pet['id'];?>">
                            <img id = "petImage" src="<?=$petPhoto["img"]?>" alt="Pet Photo" width="200" height="200">
                            <p id = "petName"><?= $pet['petname'] ?> </p>
                        </a>
                    </article>
                <?php }
            ?></div>
    </section>
</section>