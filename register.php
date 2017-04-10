<?php
// sprawdz czy przeslany form rejestracyjny
// jesli tak to zwaliduj danej i zapisz nowego usera
// jesli zapis sie powiedzie (unikalny email. itp.) to zaloguj usera i przekieruj
// na glowna strone main.php
// jesli rejestracja nieudana. wyswietl błąd
// wyswietl formularz rejestracyjny pozwalajacy wypelnic wymagane dane

require_once ('src/init.php');
include('html/header.html');

var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // if came from main page with parameters set
    // or just entered them by form below, begin registration
    if ($_POST['username'] != '' &&
            $_POST['email'] != '' &&
            $_POST['password'] != ''
    ) {
        require_once 'src/User.php';
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $date = date("Y-m-d");

        $newUser = new User();
        $newUser->setUsername($username);
        $newUser->setEmail($email);
        $newUser->setPassword($password);
        $newUser->setDateRegistered($date);
        if (($newUser->saveToDB($conn)) == false) {
//            die("check what happend:" . $conn->error);
            if ($conn->error == "Duplicate entry '$email' for key 'email'") {
                echo "<h2> We already have an user with email: $email. Try again. </h2>";
            } else {
                die("Database error: " . $conn->error);
            }
        } else {
            echo "Superb! You have been registered.";
            // redirect to login.php
            $_SESSION['logged_user_id'] = $email;
            header("location: login.php");
        }


        $conn->close();
        $conn = null;
    } else {
        echo "<h2> You need to enter correct values. </h2> ";
    }
}
?>


<div id="signup-form">
    <fieldset>
        <legend>New user? Sign up!</legend>
        <form action="#" method="post">
            <input type="text" name="username" placeholder="Username" maxlength="100">
            <br>
            <input type="email" name="email" placeholder="E-mail" maxlength="100">
            <br>
            <input type="password" name="password" placeholder="Password" maxlength="50">
            <br>
            <input type="submit" value="Sign up">
        </form>
    </fieldset>
</div>







<?php
include('html/footer.html');
?>
