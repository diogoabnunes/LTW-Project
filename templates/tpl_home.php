<?php
    include_once("../database/pets.php");
    include_once("../database/users.php");

    $pets = getAllPetsAndTheirPhotos();
    $species = getSpecies();
    $breeds = getBreeds();

    $user_info = getUserById($_SESSION['userId']);
?>

<div class="user_options">
    <a href="../actions/action_user_page.php?id=<?=$_SESSION['userId']?>"> <?=$user_info['username']?> </a> 
    <a href="../actions/action_signout.php?csrf=<?=$_SESSION['csrf']?>"> Signout </a>
</div>
<nav class="nav">
    <ul>
        <li> <a href="../pages/home.php"> Home </a> </li>
        <li> <a href="../pages/add_pet.php"> Add a Pet </a> </li>
    </ul>
</nav>
<section id="home_body">
    <aside id="filters">
        <h2> Filters </h2>
        <section id="search_specie">
            <h3> Filter by Specie </h3>
            <ul id="listSpecies" >
                <?php foreach($species as $specie) { ?>
                    <li> <input type="checkbox" name="species" value='<?=$specie['species']?>'> <label> <?=$specie['species']?> </label> </li>
                <?php } ?>
            </ul>
        </section>
        <section id="search_breed">
            <h3> Filter by Breed </h3>
            <ul id="listBreeds" >
                <?php foreach($breeds as $breed) { ?>
                    <li> <input type="checkbox" name="breeds" value='<?=$breed['breed']?>'> <label> <?=$breed['breed']?> </label> </li>
                <?php } ?>
            </ul>
        </section>
        <section id="search_gender">
            <h3> Filter by Gender </h3>
            <ul id="listGender" >
                <li> <input type="checkbox" name="gender" value="M"> <label> Male </label> </li>
                <li> <input type="checkbox" name="gender" value="F"> <label> Female </label> </li>
            </ul>
        </section>
        <section id="search_state">
            <h3> Filter by State </h3>
            <ul id="listState" >
                <li> <input type="checkbox" name="gender" value="adopted"> <label> Adopted </label> </li>
                <li> <input type="checkbox" name="gender" value="not adopted"> <label> Not Adopted </label> </li>
            </ul>
        </section>
    </aside>
    <section id="pets">
        <?php foreach($pets as $pet){ 
             $petid = getPetById($pet['id']);
             $petPhoto = getPetPhotoById($pet['id']);
        ?>
            <article class="pets">
                <a href="../actions/action_pet_info.php?id=<?php echo $petid['id'];?>">
                    <img id = "petImage" src="<?=$petPhoto["img"]?>" alt="Pet Photo">   
                    <span id="petName"> <?= $petid['petname'] ?> </span>
                </a>
            </article>
        <?php } ?>
    </section>
</section>