# spikeball-league
A web app to organize a spikeball league system with player, teams, games, stats, login, register &amp; more.

--------------------------------------------------
- Author: Fabian Dudda
- Version: 0.1
- Date: 22.07.2021
- Languages: HTML, CSS, JAVASCRIPT, PHP, SQL
--------------------------------------------------


Features:
- 1 mysql-database with 2 tables:
	- users: user_uid, user_name, user_mail, user_password, user_role
	- games: game_id, game_date, game_time, team1_points, team2_points, team1_player1, team1_player2, team2_player1, team2_player2

- You can register via form (user_name, user_mail, user_password)
	- error msg, when try to register an already existing user_name or user_mail

- You can login via form (user_name and user_password)

- You can only view index.php via login-form

- You can view all user settings

- You can edit user_name, user_mail and user_password
	- error msg, when try to register an already existing user_name or user_mail

- You can add a game:
	- Add points per dropdown list (0-21)
	- Add user per dropdown list (all registered users)
	- error msg, when try to submit without all inputs or one player selected multiple times

- You can view our own stats (win_rate, wins, deafeats, total games)

- You can view stats of other user (win_rate, wins, deafeats, total games)

- You can view a league table and sort themy by any column (user,win_rate, wins, deafeats, total games)
