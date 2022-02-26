<?php
    include_once("../database/favorite_pets.php");
    include_once("../database/pets.php");
    include_once("../database/users.php");

    $user_info = getUserById($_SESSION['userId']);
    $favorite_pets = getFavoritePets($_SESSION['userId']);
?>

<div class="user_options">
    <a href="../actions/action_user_page.php?id=<?=$_SESSION['userId']?>"> <?=$user_info['username']?> </a>
    <a href="../actions/action_signout.php?csrf=<?=$_SESSION['csrf']?>"> Signout </a>
</div>

<nav class="nav">
    <ul>
        <li> <a href="../actions/action_favorite_pets.php"> Favorite Pets </a> </li>
    </ul>
</nav>
<section id="favorite_pets_body">
    <aside>
        <p> Pets </p>
        <ul>
            <li> <a href="../pages/my_pets.php"> Added Pets </a> </li>
            <li> <a href="../pages/adopted_pets.php"> Adopted Pets </a> </li>
            <li> <a href="../pages/add_pet.php"> Add a Pet </a> </li>
        </ul>
    </aside>
    <section id="favorite_pets">
    <?php
        
        foreach($favorite_pets as $favorite_pet){ 
            $pet = getPetById($favorite_pet['petId']);
            $petPhoto = getPetPhotoById($favorite_pet['petId']);
            ?>
            <article class="favorite_pets">
                <a href="../actions/action_pet_info.php?id=<?php echo $pet['id'];?>">
                    <img id = "petImage" src="<?=$petPhoto["img"]?>" alt="Pet Photo">
                    <p id = "petName"><?= $pet['petname'] ?> </p>
                    <form action="../actions/action_remove_favorite.php" method="post">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                        <input type="hidden" name="petId" value="<?=$favorite_pet['petId']?>">
                        <input type="hidden" name="userId" value="<?=$user_info['id']?>">
                        <input id = "remove" type="submit" value="Remove">
                    </form>
                </a>
            </article>



        <?php }
    ?>
    </section>
</section>