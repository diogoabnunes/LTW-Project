<section id="signup">
    <h2> Signup </h2>  
    <form action="../actions/action_signup.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <label> Profile Picture <input type="file" name="photo" accept=".jpg,.png,.jpeg"> </label>
        <label> Name <input type="text" name="name" required/> </label>
        <label> BirthDate <input type="date" name="birthDate" value="2009-01-09" onchange="beforeToday(this.value)"> </label>
        <label> Gender </label>
        <div> <input type="radio" name="gender" value="M" checked/> Male
        <input type="radio" name="gender" value="F"/> Female </div>
        <label> Location <input type="text" name="location" /> </label>
        <label> Username <input type="text" name="username" required/> </label>
        <label> Password <input type="password" name="password" required/> </label>
        <input type="submit" value="Signup">
    </form>
    <footer> If you already have an account: <a href="signin.php"> Signin </a>  </footer>
</section>