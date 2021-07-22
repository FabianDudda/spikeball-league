<?php 

function check_login($con) {

  // check, if user is logged in
  if(isset($_SESSION['user_uid'])) 
  {
    // check for a real user
    $user_uid = $_SESSION['user_uid'];
    $query = "SELECT * FROM users where user_uid = '$user_uid' limit 1";

    $result = mysqli_query($con,$query);

    if($result && mysqli_num_rows($result) > 0){

      $user_data = mysqli_fetch_assoc($result);
      return $user_data;
    }
  }
  header("Location: login.php"); // If user is not logged in, redirect to login.php
  die;
}

function unique_user_id() 
{
  $date_1 = date("Ymd");
  $date_2 = $date_1 . date("His");

  $random_num_1 = rand(0,9);
  $random_num_2 = rand(0,9);
  $random_num_3 = rand(0,9);
  $random_num_4 = rand(0,9);
  $random_num_5 = rand(0,9);

  $date_3 = $date_2 . $random_num_1 . $random_num_2 . $random_num_3 . $random_num_4 . $random_num_5 ;

	return $date_3;
}

function date_stamp() 
{
  $date_stamp = date("Y-m-d");
  return $date_stamp;
}

function time_stamp() 
{
  $time_stamp = date("H:i:s");
  return $time_stamp;
}

?>