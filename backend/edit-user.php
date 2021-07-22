<?php

include_once 'db_connection.php';

$user_uid  = $_POST['user_uid'];
$user_name = $_POST['user_name'];
$user_mail = $_POST['user_mail'];
$user_password = $_POST['user_password'];

// Change Username
if (!empty($user_name)) 
{
  $query_user_name_check = "SELECT * FROM users WHERE user_name = '$user_name'";
  $result = mysqli_query($con, $query_user_name_check);
  $user_name_already_exist = mysqli_num_rows($result);

  if($user_name_already_exist)
  {
    echo "Usernmae already exists"; 
  }
  else 
  {
  $query = "UPDATE users SET user_name='$user_name' WHERE user_uid=$user_uid";
  mysqli_query($con, $query);
  }
}

// Change Mail
if (!empty($user_mail)) 
{
  $query_user_mail_check = "SELECT * FROM users WHERE user_mail = '$user_mail'";
  $result = mysqli_query($con, $query_user_mail_check);
  $user_mail_already_exist = mysqli_num_rows($result);

  if($user_mail_already_exist) 
  {
    echo "Mail already exists"; 
  }
  else 
  {
    $query = "UPDATE users SET user_mail='$user_mail' WHERE user_uid=$user_uid";
    mysqli_query($con, $query);
  }
}

// Change Password
if (!empty($user_password)) 
{
  $query = "UPDATE users SET user_password='$user_password' WHERE user_uid=$user_uid";

  mysqli_query($con, $query);
}

exit;

?>