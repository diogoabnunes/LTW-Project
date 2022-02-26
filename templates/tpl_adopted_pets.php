<?php
    include_once("../database/adopted_pets.php");
    include_once("../database/pets.php");
    include_once("../database/users.php");

    $adopted_pets = getAdoptedPets($_SESSION['userId']);
    $user_info = getUserById($_SESSION['userId']);
?>

<div class="user_options">
    <a href="../actions/action_user_page.php?id=<?=$_SESSION['userId']?>"> <?=$user_info['username']?> </a>
    <a href="../actions/action_signout.php?csrf=<?=$_SESSION['csrf']?>"> Signout </a>
</div>

<nav class="nav">
    <ul>
        <li> <a href="../actions/action_adopted_pets.php"> Adopted Pets </a> </li>
    </ul>
</nav>
<section id="adopted_pets_body">
    <aside>
        <p> Pets </p>
        <ul>
            <li> <a href="../pages/my_pets.php"> Added Pets </a> </li>
            <li> <a href="../pages/favorite_pets.php"> Favorite Pets </a> </li>
            <li> <a href="../pages/add_pet.php"> Add a Pet </a> </li>
        </ul>
    </aside>
    <section id="adopted_pets">
    <?php
        
        foreach($adopted_pets as $adopted_pet){ 
            $pet = getPetById($adopted_pet['petId']);
            $petPhoto = getPetPhotoByID($adopted_pet['petId']);
            ?>
            <article class="adopted_pets">
                <a href="../actions/action_pet_info.php?id=<?php echo $pet['id'];?>">
                    <img id = "petImage" src="<?=$petPhoto["img"]?>" alt="Pet Photo">
                    <p id = "petName"><?= $pet['petname'] ?> </p>
                </a>
            </article>

        <?php }
    ?>
    </section>
</section>