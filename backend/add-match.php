<?php

include_once 'db_connection.php';
include_once 'functions.php';

$team1_points   = $_POST['team1_points'];
$team2_points   = $_POST['team2_points'];
$team1_player1  = $_POST['team1_player1'];
$team1_player2  = $_POST['team1_player2'];
$team1_player2  = $_POST['team1_player2'];
$team2_player1  = $_POST['team2_player1'];
$team2_player2  = $_POST['team2_player2'];
$game_date      = date_stamp();
$game_time      = time_stamp();

if (!empty($team1_points) && !empty($team2_points) && !empty($team1_player1) && !empty($team1_player2) && !empty($team2_player1) && !empty($team2_player2)) 
{
  if (is_numeric($team1_points) && is_numeric($team2_points)) 
  {
    $query = "INSERT INTO games (game_date,game_time,team1_points,team2_points,team1_player1,team1_player2,team2_player1,team2_player2) VALUES ('$game_date','$game_time','$team1_points','$team2_points','$team1_player1','$team1_player2','$team2_player1','$team2_player2')";
    mysqli_query($con, $query);
  }
}

?>