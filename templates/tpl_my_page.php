<?php
    include_once("../database/users.php");

    $user_info = getUserById($_SESSION['userId']);
    $photo = getUserPhoto($_SESSION['userId'])['img'];

    function getGender() {
        global $user_info;
        $gender = $user_info['gender'];

        if($gender === 'M') return 'Male';
        else return 'Female';
    }

    function getChecked($button){
        global $user_info;
        $gender = $user_info['gender'];

        if($gender === $button) return "checked";
        else return "";
    }
?>

<div class="user_options">
<a href="../actions/action_signout.php?csrf=<?=$_SESSION['csrf']?>"> Signout </a>
</div>
<nav class="nav">
    <ul>
        <li> <a href="../actions/action_user_page.php?id=<?=$_SESSION['userId']?>"> <?=$user_info['username']?> </a> </li>
    </ul>
</nav>
<section id="my_page_body">
    <aside>
        <p> Pets </p>
        <ul>
            <li> <a href="../pages/my_pets.php"> Added Pets </a> </li>
            <li> <a href="../pages/favorite_pets.php"> Favorite Pets </a> </li>
            <li> <a href="../pages/adopted_pets.php"> Adopted Pets </a> </li>
            <li> <a href="../pages/add_pet.php"> Add a Pet </a> </li>
        </ul>
    </aside>
    <section id="user_info">
        <div>
            <form action="../actions/action_save_user_info.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="text" name="topic" value="user-photo" hidden>
                <img src=<?=$photo?> alt="User Photo" width="200" height="200">
                <div class="edit_user_info">
                    <span class="user_input" hidden> 
                        <input type="file" name="photo" accept=".jpg,.png,.jpeg"> 
                    </span>
                    <div class="buttons">
                        <input type="button" value="Edit">
                        <input type="button" value="Cancel" hidden>
                        <input type="submit" value="Save" hidden>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <form action="../actions/action_save_user_info.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="text" name="topic" value="username" hidden>
                <span class="topics"> Username: </span> <span class="info_topics"> <?= $user_info['username'] ?> </span>
                <div class="edit_user_info">
                    <span class="user_input" hidden> 
                        <input type="text" name="username" value=<?= $user_info['username'] ?>>
                    </span>
                    <div class="buttons">
                        <input type="button" value="Edit">
                        <input type="button" value="Cancel" hidden>
                        <input type="submit" value="Save" hidden>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <form action="../actions/action_save_user_info.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="text" name="topic" value="password" hidden>
                <span class="topics"> Password </span>
                <div class="edit_user_info">
                    <span class="user_input" id="password" hidden>
                        <label> Current Password: <input type="password" name="old_password"> </label>
                        <label> New Password: <input type="password" name="new_password"> </label>
                    </span>
                    <div class="buttons">
                        <input type="button" value="Edit">
                        <input type="button" value="Cancel" hidden>
                        <input type="submit" value="Save" hidden>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <form action="../actions/action_save_user_info.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="text" name="topic" value="name" hidden>
                <span class="topics"> Name: </span> <span class="info_topics"> <?= $user_info['name'] ?> </span>
                <div class="edit_user_info">
                    <span class="user_input" hidden> 
                        <input type="text" name="name" value=<?= $user_info['name'] ?>>
                    </span>
                    <div class="buttons">
                        <input type="button" value="Edit">
                        <input type="button" value="Cancel" hidden>
                        <input type="submit" value="Save" hidden>
                    </div>
                </div>    
            </form>
        </div>
        <div>
            <form action="../actions/action_save_user_info.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="text" name="topic" value="birth_date" hidden>
                <span class="topics"> Birth Date: </span> <span class="info_topics"> <?= $user_info['birth_date'] ?> </span>
                <div class="edit_user_info">
                    <span class="user_input" hidden> 
                        <input type="date" name="birth_date" value=<?= $user_info['birth_date'] ?> onchange="beforeToday(this.value)">
                    </span>
                    <div class="buttons">
                        <input type="button" value="Edit">
                        <input type="button" value="Cancel" hidden>
                        <input type="submit" value="Save" hidden>
                    </div>
                </div>
            </form>
        </div>
            <div>
                <form action="../actions/action_save_user_info.php" method="post">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <input type="text" name="topic" value="gender" hidden>
                    <span class="topics"> Gender: </span> <span class="info_topics"> <?=getGender()?> </span> 
                    <div class="edit_user_info">
                        <span class="user_input" hidden> 
                            <input type="radio" name="gender" value="M" <?=getChecked('M')?>/> Male
                            <input type="radio" name="gender" value="F" <?=getChecked('F')?>/> Female
                        </span>
                        <div class="buttons"> 
                            <input type="button" value="Edit">
                            <input type="button" value="Cancel" hidden>
                            <input type="submit" value="Save" hidden>
                        </div>
                    </div>
                </form>
            </div>
        <div>
            <form action="../actions/action_save_user_info.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="text" name="topic" value="location" hidden>
                <span class="topics"> Location: </span> <span class="info_topics"> <?= $user_info['location'] ?> </span>
                <div class="edit_user_info">
                    <span class="user_input" hidden> 
                        <input type="text" name="location" value=<?= $user_info['location'] ?>>
                    </span>
                    <div class="buttons">
                        <input type="button" value="Edit">
                        <input type="button" value="Cancel" hidden>
                        <input type="submit" value="Save" hidden>
                    </div>
                </div>
            </form>
        </div>
    </section>
</section>