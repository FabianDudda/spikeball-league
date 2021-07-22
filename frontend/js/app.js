console.log("app.js has started...");



// DISPLAY: USER INFO
//#region 

// Save the user values in variables.
let user_name     = document.getElementById("display-user-name").textContent;
let user_mail     = document.getElementById("display-user-mail").textContent;
let user_password = document.getElementById("display-user-password").textContent;
let user_role     = document.getElementById("display-user-role").textContent;
let user_uid      = document.getElementById("display-user-uid").textContent;

// Get the span elements by ID.
let display_user_name     = document.getElementById("display-user-name");
let display_user_mail     = document.getElementById("display-user-mail");
let display_user_password = document.getElementById("display-user-password");
let display_user_role     = document.getElementById("display-user-role");
let display_user_uid      = document.getElementById("display-user-uid");

// Set the innerHTMl of the span elements.
display_user_name.innerHTML     = "<b>Username:</b>"  + " " + user_name;
display_user_mail.innerHTML     = "<b>Mail:</b>"      + " " + user_mail;
display_user_password.innerHTML = "<b>Password:</b>"  + " " + user_password;
display_user_role.innerHTML     = "<b>Role:</b>"      + " " + user_role;
display_user_uid.innerHTML      = "<b>Unique ID:</b>" + " " + user_uid;

//#endregion


/* ================================================================================================= */
/* ======================================== XMLHTTP-REQEUST ======================================== */
/* XMLHttpRequest (XHR) objects are used to interact with servers. You can retrieve data from a URL  */
/* without having to do a full page refresh. This enables a Web page to update just part of a page   */
/* without disrupting what the user is doing. XMLHttpRequest is used heavily in AJAX programming.    */
/* ================================================================================================= */

// GET USER NAME 
//#region xmlHttpRequest: Get user_name [from mysql-table 'users'] (get-player.php)
xmlhttp_get_player = new XMLHttpRequest();                                    // 1: New request object.
xmlhttp_get_player.open("GET","./backend/get-player.php",true);	              // 2: Initializes a newly-created request, or re-initializes an existing one. 'true' indicate to perform the operation asynchronously.
xmlhttp_get_player.send();	                                                  // 3: Sends the request. If the request is asynchronous (which is the default), this method returns as soon as the request is sent.

xmlhttp_get_player.onreadystatechange = function()                            // 4: This is where you handle what to do with the response.
{
  if (xmlhttp_get_player.readyState == 4 && xmlhttp_get_player.status == 200) // 4.1: Check that everything is done.
  {	// 4.2: Get the response					    
    document.getElementById("team1_player1").innerHTML = xmlhttp_get_player.responseText; 
    document.getElementById("team1_player2").innerHTML = xmlhttp_get_player.responseText; 
    document.getElementById("team2_player1").innerHTML = xmlhttp_get_player.responseText; 
    document.getElementById("team2_player2").innerHTML = xmlhttp_get_player.responseText; 
    document.getElementById("display-any-stats-user-name").innerHTML = xmlhttp_get_player.responseText;
  }
}
//#endregion

// GET LEAGUE TABLE DATA
// #region xmlHttpRequest: Get stats [from mysql-table 'users'] (get-stats.php)
xmlhttp_get_stats = new XMLHttpRequest();                                   // 1: New request object.
xmlhttp_get_stats.open("GET","./backend/get-stats.php",true);               // 2: Initializes a newly-created request, or re-initializes an existing one. 'true' indicate to perform the operation asynchronously.
xmlhttp_get_stats.send();	                                                  // 3: Sends the request. If the request is asynchronous (which is the default), this method returns as soon as the request is sent.

xmlhttp_get_stats.onreadystatechange = function()                           // 4: This is where you handle what to do with the response.
{ 
  if (xmlhttp_get_stats.readyState == 4 && xmlhttp_get_stats.status == 200) // 4.1: Check that everything is done.
  {	  
    let parts        = xmlhttp_get_stats.responseText.split('|');           // 4.2: Get the response and split it at the '|'
    let num_of_users = (parts.length - 1);                                  // Calculate the number of users

    //#region CONSOLE.LOG
    // console.log("responseText" + xmlhttp_get_stats.responseText);
    // === OUTPUT:
    // {"name":"TestUser","winrate":53.84,"wins":7,"defeats":6,"total":13}|
    // {"name":"DerSchmetterer","winrate":44.44,"wins":8,"defeats":10,"total":18}|
    // {"name":"DieKrake","winrate":60.00,"wins":12,"defeats":8,"total":20}|
    // {"name":"Marius","winrate":50.00,"wins":7,"defeats":7,"total":14}|

    // console.log("parts[0]" + parts[0]);
    // === OUTPUT: 
    // {"name":"TestUser","winrate":53.84,"wins":7,"defeats":6,"total":13}

    // console.log("JSON.parse(parts[0].name)" + JSON.parse(parts[0]).name); // JSON.parse() creates a Javascript object from a JSON-formatted text.
    // === OUTPUT: 
    // TestUser
    //#endregion

    // ==================================== //
    //   Create table with dynamic length   //
    // ==================================== //

    let tablearea = document.getElementById('tablearea'); // Get the container
    let table     = document.createElement('table');      // Create table
    table.setAttribute("id","table");                     // Set table's id 
    let tr        = document.createElement('tr');         // Create table row
    
    // Create table header's
    let th_user         = document.createElement('th');
    let th_win_rate     = document.createElement('th');
    let th_wins         = document.createElement('th');
    let th_defeats      = document.createElement('th');
    let th_total_games  = document.createElement('th');

    // Set onclick function
    th_user.setAttribute        ("onclick", "sortTable(0)");
    th_win_rate.setAttribute    ("onclick", "sortTable(1)");
    th_wins.setAttribute        ("onclick", "sortTable(2)");
    th_defeats.setAttribute     ("onclick", "sortTable(3)");
    th_total_games.setAttribute ("onclick", "sortTable(4)");

    // Append table header to table row's
    tr.appendChild(th_user);
    tr.appendChild(th_win_rate);
    tr.appendChild(th_wins);
    tr.appendChild(th_defeats);
    tr.appendChild(th_total_games);

    // Append text node to table row cell's
    tr.cells[0].appendChild(document.createTextNode('User'));
    tr.cells[1].appendChild(document.createTextNode('WR'));
    tr.cells[2].appendChild(document.createTextNode('W'));
    tr.cells[3].appendChild(document.createTextNode('L'));
    tr.cells[4].appendChild(document.createTextNode('T'));

    // Append table row to table
    table.appendChild(tr);

    // Loop through all user
    for (let i = 0; i < num_of_users; i++) 
    {
      // console.log(JSON.parse(parts[i]));

      // Create element table row
      let tr = document.createElement('tr');

      // Create element table data and append it to table row
      tr.appendChild(document.createElement('td'));
      tr.appendChild(document.createElement('td'));
      tr.appendChild(document.createElement('td'));
      tr.appendChild(document.createElement('td'));
      tr.appendChild(document.createElement('td'));

      // Create div container for the content
      let user_name_cell   = document.createElement('div');
      let win_rate_cell    = document.createElement('div');
      let wins_cell        = document.createElement('div');
      let defeats_cell     = document.createElement('div');
      let total_games_cell = document.createElement('div');

      // Create a text node out of the object properties parts[i] and append it to the div container
      user_name_cell.appendChild(document.createTextNode(JSON.parse(parts[i]).name));
      win_rate_cell.appendChild(document.createTextNode((JSON.parse(parts[i]).winrate).toFixed(2)));
      wins_cell.appendChild(document.createTextNode(JSON.parse(parts[i]).wins));
      defeats_cell.appendChild(document.createTextNode(JSON.parse(parts[i]).defeats));
      total_games_cell.appendChild(document.createTextNode(JSON.parse(parts[i]).total));

      // Append the div container to the matching table row cell
      tr.cells[0].appendChild(user_name_cell);
      tr.cells[1].appendChild(win_rate_cell);
      tr.cells[2].appendChild(wins_cell);
      tr.cells[3].appendChild(defeats_cell);
      tr.cells[4].appendChild(total_games_cell);

      // Append the table row to the table
      table.appendChild(tr);
    }
    // Append the table to the tablearea container
    tablearea.appendChild(table);
  }
}
//#endregion



/* ================================================================================================= */
/* ============================================= FORMS ============================================= */
/* ================================================================================================= */

// FORM: EDIT USER
//#region Execute this function, when the form with the class="edit-user" is submitted.
$('form.edit-user').on('submit', function() 
{
  var that = $(this),           // Save this form.
  url = that.attr('action'),    // Save the action of this form. ("ajax.php")
  method = that.attr('method'), // Save the method of this form. ("post")
  data = {};                    // Create an empty object.

  // Loop through all input-elements with a name tag.
  that.find('[name]').each(function(index, value) 
  {
    var that = $(this),         // Save this input-element.
    name = that.attr('name'),   // Save the name of this input-element.
    value = that.val();         // Save the value of this input-element.

    data[name] = value;         // Save the value of this input-element in the data object.
  });
  //console.log(data);

  $.ajax({                      // Make an AJAX CALL
    url: url,                   // Paste URL
    method: method,             // Paste method
    data: data,                 // Paste data
    success: function(response) {
      //console.log(response); 

      if(response)              // If we get a response, username or usermail already exists.
      {
        alert("Username or mail already exists");
      }
      else                      // Else everything works and we reload the page.
      {
        function reload() {     // Timer to reload the page after 50 milliseconds
          window.location.reload();
        }
        setTimeout(reload, 100); 
      }
    }
  });
  return false;
});
//#endregion

// FORM: ADD GAME
//#region Execute this function, when the form with the class="add-match" is submitted.
$('form.add-match').on('submit', function() 
{
  var that = $(this),           // Save this form.
  url = that.attr('action'),    // Save the action of this form. ("ajax.php")
  method = that.attr('method'), // Save the method of this form. ("post")
  data = {};                    // Create an empty object. 

  // Loop through all input-elements with a name tag.
  that.find('[name]').each(function(index, value) 
  {
    var that = $(this),         // Save this input-element.
    name = that.attr('name'),   // Save the name of this input-element.
    value = that.val();         // Save the value of this input-element.

    data[name] = value;         // Save the value of this input-element in the data object.
  });
  //#region console.log()
    // console.log(data);
    // console.log(data.team1_points);
    // console.log(data.team2_points);
    // console.log(data.team1_player1);
    // console.log(data.team1_player2);
    // console.log(data.team2_player1);
    // console.log(data.team2_player2);
  //#endregion

  if (data.team1_points && data.team2_points) 
  {
    if (!isNaN(data.team1_points) && !isNaN(data.team2_points)) 
    {
      if ((data.team1_player1 != data.team1_player2) && (data.team2_player1 != data.team2_player2) && (data.team1_player1 != data.team2_player1) && (data.team1_player2 != data.team2_player2) && (data.team1_player1 != data.team2_player2) && (data.team1_player2 != data.team2_player1)) 
      {
        $.ajax({
          url: url,                   
          method: method,             
          data: data,                 
          success: function(response) {
            //console.log(response);
          }
        });
  
        function reload() {
          window.location.reload();
        }
        setTimeout(reload, 500); 
      }
      else 
      {
        window.alert("Each player is only allowed to play once per game :(");
      } 
    }
    else 
    {
      window.alert("Match points have to be numbers :("); 
    }
  }
  else 
  {
    window.alert("Missing some match points :("); 
  }
  return false;
});
//#endregion

// FORM: VIEW ANY USER STATS 
//#region Execute this function, when the form with the class="search-stats" is submitted.
$('form.search-stats').on('submit', function() 
{
  var that = $(this),           // Save this form.
  url = that.attr('action'),    // Save the action of this form. ("view-stats.php")
  method = that.attr('method'), // Save the method of this form. ("post")
  data = {};                    // Create an empty object.

  // Loop through all input-elements with a name tag.
  that.find('[name]').each(function(index, value) 
  {
    var that = $(this),         // Save this input-element.
    name = that.attr('name'),   // Save the name of this input-element.
    value = that.val();         // Save the value of this input-element.

    data[name] = value;         // Save the value of this input-element in the data object.
  });
  //console.log(data);

  $.ajax({                      // Make an AJAX CALL
    url: url,                   // Paste URL
    method: method,             // Paste method
    data: data,                 // Paste data
    success: function(response) {
      // console.log(response);

      let parts = response.split(',');

      document.getElementById("display-any-user-win-rate").innerHTML    = "WR: " + ((parts[1] / parts[0])*100).toFixed(2) + "%";
      document.getElementById("display-any-user-wins").innerHTML        = parts[1]; 
      document.getElementById("display-any-user-defeats").innerHTML     = parts[2];
      document.getElementById("display-any-user-total-games").innerHTML = "Total: " + parts[0]; 
      document.getElementById("display-any-user-stats-user-uid").innerHTML = "( " + parts[3] + " )"; 
    }
  });
  return false;
});
//#endregion



/* ================================================================================================= */
/* ======================================== OTHER FUNCTIONS ======================================== */
/* ================================================================================================= */

// SORT LEAGUE TABLE
function sortTable(n) {

  let table, rows, switching, i, x, y, should_switch, dir, switch_count = 0;

  table     = document.getElementById("table");
  switching = true;
  dir       = "asc";    // Set the sorting direction to ascending
  
  while (switching)     // Make a loop that will continue until no switching has been done
  {
    switching = false;  // Start by saying: no switching is done
    rows      = table.rows;
  
    for (i = 1; i < (rows.length - 1); i++) // Loop through all table rows (except the first, which contains table headers) 
    {
      should_switch = false;                // Start by saying there should be no switching
  
      // Get the two elements you want to compare, one from current row and one from the next
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
          
      // If it is NOT a number:    xContent = x.textContent.toLowerCase()
      // Else (if it is a number): xContent = parseInt(x.textContent)
      let xContent=isNaN(parseInt(x.textContent))?x.textContent.toLowerCase():parseInt(x.textContent);
      let yContent=isNaN(parseInt(y.textContent))?y.textContent.toLowerCase():parseInt(y.textContent);

      // If xContent contains a '-', set it to 0 (for string comparison)
      xContent=(xContent=='-')?0:xContent;
      yContent=(yContent=='-')?0:yContent;

      // Check if the two rows should switch place, based on the direction, asc or desc
      if (dir == "asc") 
      {
        // If x > y, mark as switch and break the loop
        if (xContent > yContent) 
        {
          should_switch = true;
          break;
        }
      }
      else if (dir == "desc")
      {
        // If x < y, mark as switch and break the loop
        if(xContent < yContent) 
        {
          should_switch = true;
          break;
        }
      }
    }
    // If a switch has been marked, make switch and mark that a switch has been done
    if (should_switch) 
    {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;

      switch_count++;
    }
    else 
    {
      // If no switch has been done AND the direction is "asc", set the direction to "desc" and run the while loop again
      if(switch_count == 0 && dir == "asc")
      {
        dir = "desc";
        switching = true;
      }
    }
  }
}

