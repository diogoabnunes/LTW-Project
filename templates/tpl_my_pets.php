<?php
    include_once("../database/my_pets.php");
    include_once("../database/pets.php");
    include_once("../database/users.php");

    $my_pets = getMyPets($_SESSION['userId']);
    $user_info = getUserById($_SESSION['userId']);
?>

<div class="user_options">
    <a href="../actions/action_user_page.php?id=<?=$_SESSION['userId']?>"> <?=$user_info['username']?> </a>
    <a href="../actions/action_signout.php?csrf=<?=$_SESSION['csrf']?>"> Signout </a>
</div>

<nav class="nav">
    <ul>
        <li> <a href="../actions/action_my_pets.php"> Added Pets </a> </li>
    </ul>
</nav>
<section id="my_pets_body">
    <aside>
        <p> Pets </p>
        <ul>
            <li> <a href="../pages/favorite_pets.php"> Favorite Pets </a> </li>
            <li> <a href="../pages/adopted_pets.php"> Adopted Pets </a> </li>
            <li> <a href="../pages/add_pet.php"> Add a Pet </a> </li>
        </ul>
    </aside>
    <section id="my_pets">
    <?php
        
        foreach($my_pets as $my_pet){ 
            $pet = getPetById($my_pet['petId']);
            $petPhoto = getPetPhotoByID($my_pet['petId']);
            ?>
            <article class="my_pets">
                <a href="../actions/action_pet_info.php?id=<?php echo $pet['id'];?>">
                    <img id = "petImage" src="<?=$petPhoto["img"]?>" alt="Pet Photo">
                    <p id = "petName"><?= $pet['petname'] ?> </p>
                </a>
            </article>

        <?php }
    ?>
    </section>
</section>