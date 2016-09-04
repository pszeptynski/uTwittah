<?php
require_once('src/init.php');
var_dump($_SESSION);

//            $_SESSION['logged_user_id'] = "omg@pl";


//$_SESSION['logged_user_id'] = $id
// sprawdz czy user zalogowany, jesli nie wyswietl strone z rejestracja i logowaniem

if (isset($_SESSION['logged_user_id'])) {
// jesli zalogowany to wczytaj main.php
header("location: main.php");
} else {
    
}





include('html/header.html');
?>

<h1>Welcome to uTwittah!</h1>
<p>
    Connect with your friends — and other fascinating people.
    Get in-the-moment updates on the things that interest you.
    And watch events unfold, in real time, from every angle.

</p>

<div id="login-form">
    <fieldset>
        <legend>Login to continue!</legend>
        <form action="#" method="post">
            <input type="email" name="email" placeholder="Your e-mail">
            <br>
            <input type="password" name="password" placeholder="Password">
            <br>
            <label>
                <input type="checkbox" value="1" name="remember_me">
                <span>Remember me</span>
            </label>
            <br>
            <input type="submit" value="Log in">
        </form>
    </fieldset>
</div>

<div id="signup-form">
    <fieldset>
        <legend>New user? Sign up!</legend>
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <br>
            <input type="email" name="email" placeholder="E-mail">
            <br>
            <input type="password" name="password" placeholder="Password">
            <br>
            <input type="submit" value="Sign up">
        </form>
    </fieldset>
</div>







<?php
include('html/footer.html');
?>
