<?php

session_start();

if(isset($_SESSION['user_uid']))
{
    unset($_SESSION['user_uid']);
}

header("Location: login.php");
die;

?>