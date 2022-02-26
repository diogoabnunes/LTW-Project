<?php
    include_once("../database/pets.php");
    include_once("../database/users.php");

    $user_info = getUserById($_SESSION['userId']);

?>

<div class="user_options">
    <a href="../actions/action_user_page.php?id=<?=$_SESSION['userId']?>"> <?=$user_info['username']?> </a> 
    <a href="../actions/action_signout.php?csrf=<?=$_SESSION['csrf']?>"> Signout </a>
</div>

<nav class="nav">
    <ul>
        <li> <a href="../pages/add_pet.php"> Add a Pet </a> </li>
    </ul>
</nav>
<section id="add_pet_body">
    <section id="add_pet">
        <p id = "pet_info_header">Pet Info</p>
        <form action="../actions/action_add_pet.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">

            <div>
            <p>Name:</p>
            <input id = "text_field" type="text" value="" name="name" required>
            </div>

            <div>
            <p>Species:</p>
            <select name="species" onchange="getBreeds(this.value)" required>
                <option value = "" ></option>
                <?php 
                $species = getSpecies();
                foreach($species as $specie){?>
                    <option value = "<?=$specie['species']?>" ><?=$specie['species']?></option>
                <?php } ?>    
            </select>
            </div>

            <div>
            <p>Breed:</p>
            <select id = 'breedList' name="breed" required>
            </select>
            </div>

            <div>
            <p>Birthday:</p>
            <input class = "text_field" type="date" value="" name="bday" required onchange="beforeToday(this.value)">
            </div>
            
            <div>
            <p>Gender:</p>
            <input type="radio" name="gender" value="M" name="male" required/> Male
            <input type="radio" name="gender" value="F" name="female" required/> Female
            </div>

            <div>
            <p>Colour:</p>
            <select id = 'breedList' name="colour" required>
                <option value = "" ></option>
                <option value = "Red" >Red</option>
                <option value = "Green" >Green</option>
                <option value = "Blue" >Blue</option>
                <option value = "Yellow" >Yellow</option>
                <option value = "Black" >Black</option>
                <option value = "White" >White</option>
                <option value = "Grey" >Grey</option>
                <option value = "Brown" >Brown</option>
                <option value = "Orange" >Orange</option>
                <option value = "Purple" >Purple</option>
                <option value = "Pink" >Pink</option>
                <option value = "Beige" >Beige</option>
            </select>
            </div>

            <div>
            <p>Location:</p>
            <input class = "text_field" type="text" value="" name="location" required>
            </div>

            <div>
            <p>Photo:</p>
            <label for="image"> Select a image to upload </label>
            <input id="imgupload" type="file" name="image" value="imageupload" accept=".jpg,.png,.jpeg" required>
            </div>

            <div>
            <p>Description:</p>
            <input class = "text_field" type="text" value="" name="description" required>
            </div>

            <div>
            <input id = "add_button" type="submit" value="Add Pet" required>
            </div>

        </form>
  
    </section>
</section>