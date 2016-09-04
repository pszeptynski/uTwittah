<?php

session_start();

unset($_SESSION['logged_user_id']);

header("location: index.php");
?>
