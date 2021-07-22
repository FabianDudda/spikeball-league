<?php 
  session_start();

    include("backend/db_connection.php");
    include("backend/functions.php");

    // If user is already logged in, redirect to index.php
    if(isset($_SESSION['user_uid'])) 
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
      // Save the entries in variables
      $user_name = $_POST['user_name'];
      $user_password = $_POST['user_password'];

      if(!empty($user_name) && !empty($user_password))
      {

        // Read from database
        $query = "SELECT * FROM users where user_name = '$user_name' limit 1";

        $result = mysqli_query($con, $query);

        if($result) {
          if($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);
            
            if($user_data['user_password'] === $user_password) {

              $_SESSION['user_uid'] = $user_data['user_uid'];
              header("Location: index.php");
              die;
            }
          }
        }
        echo "Wrong username or password!";

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
    <title>Login</title>
  </head>
  <body>

  <div class="row">
    <div class="col-6">
      <form method="post">

        <div class="form-header">Login</div>

        <input class="text-input" type="text" name="user_name" placeholder="Username">
        <input class="text-input" type="password" name="user_password" placeholder="Password">

        <input class="btn-1" type="submit" value="Login">
        <input class="btn-2" type="button" value="No account yet? Click here to register!" onclick="location.href='register.php';">

      </form>
    </div>     
  </div>

  </body>
</html>