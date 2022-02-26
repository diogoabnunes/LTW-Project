</section>
<section id="signin">
    <h2> Signin </h2>  
    <form action="../actions/action_signin.php" method="post">
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <label> Username <input type="text" name="username" required/> </label>
        <label> Password <input type="password" name="password" required/> </label>
        <input type="submit" value="Signin">
    </form> 
    <footer> If you don't have an account: <a href="signup.php"> Signup </a> </footer>
</section>