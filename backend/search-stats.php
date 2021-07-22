<?php

include_once 'db_connection.php';

$user_uid = $_POST['display-any-stats-user-name'];

// TOTAL NUMBER OF GAMES
$sql                   = "SELECT COUNT(*) FROM games WHERE team1_player1 = '$user_uid' OR team1_player2 = '$user_uid' OR team2_player1 = '$user_uid' OR team2_player2 = '$user_uid'";
$result                = mysqli_query($con, $sql);
$number_of_total_games = mysqli_fetch_array($result);

// TOTAL NUMBER OF WINS
$sql2                  = "SELECT COUNT(*) FROM games WHERE (team1_player1 = '$user_uid' AND team1_points > team2_points) OR (team1_player2 = '$user_uid' AND team1_points > team2_points) OR (team2_player1 = '$user_uid' AND team2_points > team1_points) OR (team2_player2 = '$user_uid' AND team2_points > team1_points) ";
$result2               = mysqli_query($con, $sql2);
$number_of_wins        = mysqli_fetch_array($result2);

// TOTAL NUMBER OF DEFEATS
$sql3                  = "SELECT COUNT(*) FROM games WHERE (team1_player1 = '$user_uid' AND team1_points < team2_points) OR (team1_player2 = '$user_uid' AND team1_points < team2_points) OR (team2_player1 = '$user_uid' AND team2_points < team1_points) OR (team2_player2 = '$user_uid' AND team2_points < team1_points) ";
$result3               = mysqli_query($con, $sql3);
$number_of_defeats     = mysqli_fetch_array($result3);

echo $number_of_total_games[0], "," ,$number_of_wins[0], "," ,$number_of_defeats[0], "," ,$user_uid;

exit;

?>