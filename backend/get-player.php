<?php

include_once 'db_connection.php';

$sql         = "SELECT * FROM users";
$result      = mysqli_query($con, $sql); // $con = database connection ; $sql = fetch statement
$resultCheck = mysqli_num_rows($result); // This is the number of rows.

if ($resultCheck > 0) // If there is at least one row.
{
  while ($row = mysqli_fetch_assoc($result)) // Loop through all rows and echo the values.
  {
    echo '<option value="'.$row['user_uid'].'">' . $row['user_name'] . "</option>";      
  }
}

?> 



