<?php

session_start();

include("backend/db_connection.php");
include("backend/functions.php");

// Check, if the user is logged in.
$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="frontend/scss/styles.css">
    <title>Spike League</title>       
  </head>
  <body>

  <h1>Spike League</h1>
  <p>Hello, <?php echo $user_data['user_name']; ?> :) <a class="btn-1" href="logout.php">LOGOUT</a></p> 

  <h2 style="color:purple;">USER SECTION</h2> <br>

  <!-- DISPLAY USER INFO -->
  <div class="row">
    <div class="col-6">
      <div class="user-info-container">

        <h2>User Info</h2>
        
        <span id="display-user-name">     <?php echo $user_data['user_name'];     ?> </span>
        <span id="display-user-mail">     <?php echo $user_data['user_mail'];     ?> </span>
        <span id="display-user-password"> <?php echo $user_data['user_password']; ?> </span>
        <span id="display-user-role">     <?php echo $user_data['user_role'];     ?> </span>
        <span id="display-user-uid">      <?php echo $user_data['user_uid'];      ?> </span>

      </div>
    </div>
  </div>

  <br>

  <!-- EDIT USER INFO -->
  <div class="row">
    <form action="backend/edit-user.php" method="post" class="edit-user">
      <div class="col-6">
       <div class="user-edit-container">
  
        <h2>Edit User</h2>

        <label for="user_name">Username</label>
        <input class="text-input" type="text" name="user_name" placeholder="Username" value="">
    
        <label for="user_mail">Mail</label>
        <input class="text-input" type="text" name="user_mail" placeholder="Mail" value="">   
      

        <label for="user_password">Password</label>
        <input class="text-input" type="text" name="user_password" placeholder="Password" value="">           

        <input type="text" name="user_role" style="display:none" value="<?php echo $user_data['user_role']; ?>">   
        <input type="text" name="user_uid"  style="display:none" value="<?php echo $user_data['user_uid'];  ?>">    
    
        <input class="btn-1" type="submit" value="Edit"> 
  
        </div>
      </div>
    </form>
  </div>

  <br>

  <!-- ADD MATCH -->
  <div class="row">
    <div class="col-6">
      <form action="backend/add-match.php" method="post" class="add-match">
        <div class="add-match-container">

          <h2>Add Game</h2>
           
          <div class="add-match-row">

            <!-- Team 1 -->
            <div class="add-match-team-1">
              <b>Team 1</b>
              <select name="team1_player1" id="team1_player1" class="add-match-select-player-team-1">
                <!-- <option> Username </option>-->
              </select>
              <select name="team1_player2" id="team1_player2" class="add-match-select-player-team-1">
                <!-- <option> Username </option>-->
              </select>
              <select name="team1_points" class="add-match-points-team-1">
                <option value="" disabled selected> 0 </option>
                <option value="00"> 0 </option>
                <option value="1">  1 </option>
                <option value="2">  2 </option>
                <option value="3">  3 </option>
                <option value="4">  4 </option>
                <option value="5">  5 </option>
                <option value="6">  6 </option>
                <option value="7">  7 </option>
                <option value="8">  8 </option>
                <option value="9">  9 </option>
                <option value="10"> 10 </option>
                <option value="11"> 11 </option>
                <option value="12"> 12 </option>
                <option value="13"> 13 </option>
                <option value="14"> 14 </option>
                <option value="15"> 15 </option>
                <option value="16"> 16 </option>
                <option value="17"> 17 </option>
                <option value="18"> 18 </option>
                <option value="19"> 19 </option>
                <option value="20"> 20 </option>
                <option value="21"> 21 </option>
              </select> 
            </div>

            <div class="add-match-vs">  
              <b>VS</b>  
            </div>
           
            <!-- Team 2 -->
            <div class="add-match-team-2">
              <b>Team 2</b>
              <select name="team2_player1" id="team2_player1" class="add-match-select-player-team-2">
                <!-- <option> Username </option>-->
              </select>  
              <select name="team2_player2" id="team2_player2" class="add-match-select-player-team-2">
                <!-- <option> Username </option>-->
              </select>
              <select name="team2_points" class="add-match-points-team-2">
                <option value="" disabled selected> 0 </option>
                <option value="00"> 0 </option>
                <option value="1">  1 </option>
                <option value="2">  2 </option>
                <option value="3">  3 </option>
                <option value="4">  4 </option>
                <option value="5">  5 </option>
                <option value="6">  6 </option>
                <option value="7">  7 </option>
                <option value="8">  8 </option>
                <option value="9">  9 </option>
                <option value="10"> 10 </option>
                <option value="11"> 11 </option>
                <option value="12"> 12 </option>
                <option value="13"> 13 </option>
                <option value="14"> 14 </option>
                <option value="15"> 15 </option>
                <option value="16"> 16 </option>
                <option value="17"> 17 </option>
                <option value="18"> 18 </option>
                <option value="19"> 19 </option>
                <option value="20"> 20 </option>
                <option value="21"> 21 </option>
              </select> 
            </div>

          </div>

          <div class="add-match-row">
            <input class="btn-1" type="submit" value="Add"> 
          </div>
     
        </div>
      </form>
    </div>
  </div>
  
  <br>

  <!-- SEARCH STATS -->
  <div class="row">
    <div class="col-6">
      <form action="backend/search-stats.php" method="post" class="search-stats">
        <div class="user-stats-container">

          <div class="user-stats-row">
            <h2>User Stats</h2>
            <span id="display-any-user-stats-user-uid"></span>
          </div>

          <div class="user-stats-row">
            <span id="display-any-user-win-rate">WR: 0.00%</span>
            <div id="display-win-defeat">
              (W/L)
              <span id="display-any-user-wins">0</span>-<span style="color: red;" id="display-any-user-defeats">0</span>
            </div>
            <span id="display-any-user-total-games">Total: 0</span>
          </div>

          <select name="display-any-stats-user-name" id="display-any-stats-user-name" class="display-any-stats-user-name">
              <!-- <option> Username </option>-->
          </select>

          <input class="btn-1" type="submit" value="Show"> 
        
        </div>
      </form>
    </div>
  </div>

  <br>

  <!-- TABLE -->
  <br>
  <div id="tablearea">
  </div>
  <br>


  <!-- EXAMPLE MOBILE RESPONSIVE ROW AND COL -->
  <div class="row">
    <div class="col-3" style="background-color:red">Col-3</div>    <!-- 25% Width-->
    <div class="col-6" style="background-color:blue">Col-6</div>   <!-- 50% Width-->
    <div class="col-9" style="background-color:red">Col-9</div>    <!-- 75% Width-->
    <div class="col-12" style="background-color:blue">Col-12</div> <!-- 100% Width-->
  </div>

  <br>
  <h2 style="color:orange;">TO DO: ADMIN SECTION</h2>
  <p>Here will be the admin section</p>


  <!-- Embed JQuery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

  <!-- Embed JavaScript file. -->
  <script type="text/javascript" src="frontend/js/app.js"></script>

  </body>
</html>