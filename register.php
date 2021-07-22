<?php 
session_start();

  include("backend/db_connection.php");
  include("backend/functions.php");

  if(isset($_SESSION['user_uid'])) // If user is already logged in, redirect to index.php
  {
    $user_uid = $_SESSION['user_uid'];
    $query    = "SELECT * FROM users where user_uid = '$user_uid' limit 1";
    $result   = mysqli_query($con,$query);

    if($result && mysqli_num_rows($result) > 0)
    {
    header("Location: index.php");
    }
  } 

  if($_SERVER['REQUEST_METHOD'] == "POST") 
  {
    // Save the entries as variables.
    $user_name = $_POST['user_name'];
    $user_mail = $_POST['user_mail'];
    $user_password = $_POST['user_password'];

    if(!empty($user_name) && !empty($user_mail) && !is_numeric($user_password)) 
    {
      $query_user_mail_check = "SELECT * FROM users WHERE user_mail = '$user_mail'";
      $result = mysqli_query($con, $query_user_mail_check);
      $user_mail_already_exist = mysqli_num_rows($result);

      $query_user_name_check = "SELECT * FROM users WHERE user_name = '$user_name'";
      $result = mysqli_query($con, $query_user_name_check);
      $user_name_already_exist = mysqli_num_rows($result);

      if($user_mail_already_exist) 
      {
        echo "Usermail already exists!";
      }
      else if($user_name_already_exist)
      {
        echo "Username already exists!";
      }
      else 
      {
        $user_uid = unique_user_id(); // Generate random unqiue user id.

        $query = "INSERT INTO users (user_uid,user_name,user_mail,user_password) VALUES ('$user_uid','$user_name','$user_mail','$user_password')";
        mysqli_query($con, $query);

        header("Location: login.php"); // Relocate to login.php
        die;
      }
    }
    else 
    {
      echo "Please enter some valid information!";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="frontend/scss/styles.css">
    <title>Register</title>
  </head>
  <body>

  <div class="row">
    <div class="col-6">
      <form method="post">

      <div class="form-header">Register</div>

      <input class="text-input" type="text" name="user_name" placeholder="Username">
      <input class="text-input" type="text" name="user_mail" placeholder="Mail">
      <input class="text-input" type="password" name="user_password" placeholder="Password">

      <input class="btn-1" type="submit" value="Register">
      <input class="btn-2" type="button" value="Already register? Click to Login." onclick="location.href='login.php';">
        
      </form>
    </div>
  </div>

  </body>
</html>