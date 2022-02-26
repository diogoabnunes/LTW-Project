<?php
    include_once("../database/pets.php");
    include_once("../database/users.php");
    include_once("../database/pet_info.php");
    include_once("../database/adopted_pets.php");

    $petid =  $_SESSION['petId'];
    $pet_info = getPetById($petid); 
    $pet_species = getSpeciesN($petid); 
    $photo =  getPetPhotoById($petid);
    $comments = getComments($petid);
    $propose = getPropose($petid);
    $user_info = getUserById($_SESSION['userId']);
    $user_added_pet = getUserAddedPet($petid);

    $current_owner;
    if($pet_info['state'] === "not adopted")  $current_owner = $user_added_pet;
    else $current_owner = getUserAdoptedPet($petid);

    function displayComment($comment, $associatedPropose) {
        if($comment['proposeId'] === $associatedPropose) {
                $user = getUserById($comment['userId']); ?>
                <article class="comment">
                        <p> <span class="comment_topic"> Author: </span> <span class="comment_author"> <a href="../actions/action_user_page.php?id=<?=$user['id']?>"> <?= $user['username'] ?> </a> </span> </p>
                        <p> <span class="comment_topic"> Date: </span> <span class="comment_date"> <?= $comment['date'] ?> </span> </p>
                        <p> <span class="comment_topic"> Hour: </span> <span class="comment_hour"> <?= $comment['hour'] ?> </span> </p>
                        <p class="comment_body"> <?= $comment['comment'] ?> </p>
                </article>
        <?php }
    }

    function displayPropose($propose, $comments) {

        $proposesListEmpty = false;
        
        global $user_info, $pet_info;
        
        $user = getUserById($propose['userId']);
        
        ?>
        <article class="propose">
                <input type="hidden" name="proposeId" value=<?=$propose['id']?>>
                <p> <span class="propose_topic"> Author: </span> <span class="propose_author"><a href="../actions/action_user_page.php?id=<?=$user['id']?>"><?= $user['username'] ?></a></span> </p>
                <p> <span class="propose_topic"> Date: </span> <span class="propose_date"><?= $propose['date'] ?> </span> </p>
                <p> <span class="propose_topic"> Hour: </span> <span class="propose_hour"><?= $propose['hour'] ?> </span> </p>
                <p> <span class="propose_topic"> State: </span> <span class="propose_state"><?= $propose['state'] ?></span> </p>
                <p class="propose_body"> <?= $propose['description'] ?> </p>
                <article class="comments_on_propose">
                        <?php foreach($comments as $comment) 
                                displayComment($comment, $propose['id']); ?>
                </article>
                <?php if($propose['state'] === "processing") displayCommentInput($propose['id']); ?>
                <?php displayAcceptAndRejectButtons($propose); ?>
        </article>
    <?php }

    function displayCommentInput($proposeAssociated) { 
        global $user_info, $petid; 
        
        if($proposeAssociated === null) $proposeAssociated = "null"?>

        <div class='add_comment'>
                <input type='hidden' name='proposeId' value=<?=$proposeAssociated?>>
                <input type='hidden' name='userId' value=<?=$user_info['username']?>>
                <input type='hidden' name='petId' value=<?=$petid?>>
                <textarea name="propose" placeholder="Insert your comment here!"></textarea>
                <input type='button' value='Comment'>
        </div>

    <?php }

    function displayProposeInput() { 
        global $current_owner, $user_info, $petid, $user_added_pet; 
        
        if($current_owner['id'] === $_SESSION['userId']) return; ?>

        <div class='add_propose'>
                <input type='hidden' name='userId' value=<?=$user_info['username']?>>
                <input type='hidden' name='petId' value=<?=$petid?>>
                <textarea name="propose" placeholder="Insert your propose here!"></textarea>
                <input type='button' value="Propose">
        </div>
    <?php }

    function displayAcceptAndRejectButtons($propose) { 
        global $current_owner, $user_info, $petid, $user_added_pet; 
        
        if($current_owner['id'] !== $_SESSION['userId'] || $propose['state'] !== "processing") return;?>
        <div class="propose_answers">
                <input type='button' value='Accept'>
                <input type='button' value='Reject'>
        </div>
    <?php }
?>

<div class="user_options">
    <a href="../actions/action_user_page.php?id=<?=$_SESSION['userId']?>"> <?=$user_info['username']?> </a> 
    <a href="../actions/action_signout.php?csrf=<?=$_SESSION['csrf']?>"> Signout </a>
</div>
<nav class="nav">
    <ul>
        <li> <a href="../actions/action_pet_info.php?id=<?=$petid?>"> <?= $pet_info['petname'] ?>'s Page </a> </li>
    </ul>
</nav>
<section id="pet_info_body">
        <input type="hidden" name="userId" value=<?=$_SESSION['userId']?>>
        <input type="hidden" name="petId" value=<?=$_SESSION['petId']?>>
        <input type="hidden" name="csrf" value=<?=$_SESSION['csrf']?>>
        <section id="pet_info">
                <div class = "imgFav"> 

                        <div id ="image">
                                <form method='post'>
                                <input id = "previous" type="button" value="<<" onclick="previousPhoto(<?=$petid?>,<?=$photo['id']?>)">
                                </form>

                                <img src=<?=$photo['img']?> width="200" height="200"> 

                                <form method='post'>
                                <input id = "next" type="button" value=">>" onclick="nextPhoto(<?=$petid?>,<?=$photo['id']?>)">
                                </form>
                        </div>

                <?php 
                
                        if(isPetFavorite($petid,$user_info['id'])){ ?>
                                <form class="favorite" action="../actions/action_remove_favorite_from_pet_info.php" method="post">
                                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                                <input type="hidden" name="petId" value="<?=$petid?>">
                                <input type="hidden" name="userId" value="<?=$user_info['id']?>">
                                <input id = "remove" type="submit" value="Remove Favorite">
                                </form>
                        <?php } else { ?>
                                <form class="favorite" action="../actions/action_add_favorite.php" method="post">
                                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                                <input type="hidden" name="petId" value="<?=$petid?>">
                                <input type="hidden" name="userId" value="<?=$user_info['id']?>">
                                <input id = "favorite" type="submit" value="Favorite">
                                </form>
                        <?php }
                
                
                ?>

                </div>

                <?php 
                if($current_owner['id'] === $_SESSION['userId']){
                        ?>
                        <form id="addPhoto" action="../actions/action_add_pet_photo.php" method="post" enctype="multipart/form-data">
                                <div>
                                <label id="addnewimg" for="image">Add new image of pet:  </label>
                                <input type="hidden" name="petId" value="<?=$petid?>">
                                <input id="imgupload" type="file" name="image" value="imageupload" accept=".jpg,.png,.jpeg" required>
                                </div>
                                <input id = "add_button" type="submit" value="Add Photo" required>
                        </form>
                        <?php
                }
                ?>

                <div>
                <div class = "imgFav"> <span class="topics"> Pet Description: </span> <span class="info_topics"> <?= $pet_info['description'] ?> </span></div>
                <div class = "imgFav"> <span class="topics"> Pet Name: </span> <span class="info_topics"> <?= $pet_info['petname'] ?> </span> </div>
                <div class = "imgFav"> <span class="topics"> Species: </span> <span class="info_topics"> <?= $pet_species['species'] ?> </span> </div>
                <div class = "imgFav"> <span class="topics"> Breed: </span> <span class="info_topics"> <?= $pet_species['breed'] ?> </span> </div>
                <div class = "imgFav"> <span class="topics"> Gender: </span> <span class="info_topics"> <?=$pet_info['gender']?> </span> </div>
                <div class = "imgFav"> <span class="topics"> Color: </span> <span class="info_topics"> <?= $pet_info['color'] ?> </span> </div>
                <div class = "imgFav"> <span class="topics"> Birth Date: </span> <span class="info_topics"> <?= $pet_info['birth_date'] ?> </span> </div>
                <div class = "imgFav"> <span class="topics"> Location: </span> <span class="info_topics"> <?= $pet_info['location'] ?> </span> </div>
                <div class = "imgFav"> <span class="topics"> Added by: </span> <span class="info_topics"> <a href="../actions/action_user_page.php?id=<?=$user_added_pet['id']?>"> <?= $user_added_pet['username'] ?> </a> </span> </div>
                <div class = "imgFav"> <span class="topics"> State: </span> <span class="info_topics"> <?= $pet_info['state'] ?> </span> </div>
                <div class = "imgFav"> <span class="topics"> Current Owner: </span> <span class="info_topics"> <a href="../actions/action_user_page.php?id=<?=$current_owner['id']?>"><?=$current_owner['username']?></a> </span> </div>
                </div>
        </section>
        <section id="comments">
                <p class="topics"> Comments: </p> 
                <div class='comment_box'>
                        <?php foreach($comments as $com)
                                displayComment($com, NULL);
                        ?>
                </div>
                <?php displayCommentInput(NULL); ?>
        </section>
        <section id = "proposes">
                <p class="topics"> Proposes: </p> 
                <div class=propose_box>
                        <?php foreach($propose as $prp)
                                displayPropose($prp, $comments);
                        ?>
                </div>
                <?php if($pet_info['state'] === "not adopted") displayProposeInput(); ?>
        </section>
</section>