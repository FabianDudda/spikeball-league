<?php

include_once 'db_connection.php';

$sql         = "SELECT * FROM users";
$result      = mysqli_query($con, $sql); // $con = database connection ; $sql = fetch statement
$resultCheck = mysqli_num_rows($result); // This is the number of rows.

class User {
  public string $name;
  public float $winrate;
  public int $wins;
  public int $defeats;
  public int $total;
}  

if ($resultCheck > 0) // If there is at least one row.
{ 
  while ($row = mysqli_fetch_assoc($result)) // Loop through all rows and echo the values.
  {
    $user_uid  = $row['user_uid'];
    $user_name = $row['user_name'];
    //console.log($user_name);

    // TOTAL NUMBER OF GAMES
    $sql1                  = "SELECT COUNT(*) FROM games WHERE team1_player1 = '$user_uid' OR team1_player2 = '$user_uid' OR team2_player1 = '$user_uid' OR team2_player2 = '$user_uid'";
    $result1               = mysqli_query($con, $sql1);
    $number_of_total_games = mysqli_fetch_array($result1);

    // TOTAL NUMBER OF WINS
    $sql2                  = "SELECT COUNT(*) FROM games WHERE (team1_player1 = '$user_uid' AND team1_points > team2_points) OR (team1_player2 = '$user_uid' AND team1_points > team2_points) OR (team2_player1 = '$user_uid' AND team2_points > team1_points) OR (team2_player2 = '$user_uid' AND team2_points > team1_points) ";
    $result2               = mysqli_query($con, $sql2);
    $number_of_wins        = mysqli_fetch_array($result2);

    // TOTAL NUMBER OF DEFEATS
    $sql3                  = "SELECT COUNT(*) FROM games WHERE (team1_player1 = '$user_uid' AND team1_points < team2_points) OR (team1_player2 = '$user_uid' AND team1_points < team2_points) OR (team2_player1 = '$user_uid' AND team2_points < team1_points) OR (team2_player2 = '$user_uid' AND team2_points < team1_points) ";
    $result3               = mysqli_query($con, $sql3);
    $number_of_defeats     = mysqli_fetch_array($result3);

    if($number_of_total_games[0] == 0) // If a user has 0 total games, set every variable to 0.
    {
      $user           = new User();    
      $user->name     = $user_name;
      $user->winrate  = 0.00;
      $user->wins     = 0;
      $user->defeats  = 0;
      $user->total    = 0;
    }
    else 
    {
      $user           = new User();    
      $user->name     = $user_name;
      $user->winrate  = (($number_of_wins[0] / $number_of_total_games[0]) * 100);
      $user->wins     = $number_of_wins[0];
      $user->defeats  = $number_of_defeats[0];
      $user->total    = $number_of_total_games[0];
    }
    echo json_encode($user);  //json_encode() encode a value to JSON format.
    echo "|";
  }
}

?> 



