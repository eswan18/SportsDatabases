<!DOCTYPE html>

<html class="no-js" lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
  <meta charset="utf-8">
  <meta name="viewport" content=
  "width=device-width, initial-scale=1.0">

  <title>Search by Team</title>
  <link rel="stylesheet" href="stylesheets/app.css" type="text/css">
  <script src="bower_components/modernizr/modernizr.js" type=
  "text/javascript">
</script>
</head>
<?php
require('navigation.php')
?>
<body>
  <div class="row">
    <div class="large-12 columns">
      <center>
        <h1>View Tables</h1>
      </center>
    </div>
  </div>

  <div class="row">
    <div class="large-10 large-offset-1 columns">
      <div class="panel">
        <?php
          $user = "lcronin";
          $password = "lcronin";
          $connString = "xe";
          $conn = oci_connect($user,$password,$connString)
            or die ("Failed Connection");
	  
	  $play=strtoupper($_POST['play_desc']);
	  $off_team=strtoupper($_POST['off_team']);
	  $def_team=strtoupper($_POST['def_team']);
	  //preg_replace("/[^a-z]/", '', $play);
	  //preg_replace("/[^a-z]/", '', $team);

	  $play=trim($play);
	  $off_team=trim($off_team);
	  $def_team=trim($def_team);

	  function team_name($a) {
	    switch ($a) {
		case 'ARIZONA':
		case 'CARDINALS':
		case 'ARIZONA CARDINALS':
		case 'CARDS':
		  return 'Arizona';
		case 'ATLANTA':
		case 'FALCONS':
		case 'ATLANTA FALCONS':
		  return 'Atlanta';
		case 'BALTIMORE':
		case 'RAVENS':
		case 'BALTIMORE RAVENS':
		  return 'Baltimore';
		case 'BILLS':
		case 'BUFFALO':
		case 'BUFFALO BILLS':
		  return 'Buffalo';
		case 'CAROLINA':
		case 'PANTHERS':
		case 'CAROLINA PANTHERS':
		case 'NORTH CAROLINA':
		case 'SOUTH CAROLINA':
		  return 'Carolina';
		case 'CHICAGO':
		case 'BEARS':
		case 'CHICAGO BEARS':
		  return 'Chicago';
		case 'CINCINNATI':
		case 'BENGALS':
		case 'CINCINNATI BENGALS':
		  return 'Cincinnati';
		case 'BROWNS':
		case 'CLEVELAND':
		case 'CLEVELAND BROWNS':
		  return 'Cleveland'; 
		case 'DALLAS':
		case 'COWBOYS':
		case 'DALLAS COWBOYS':
		case 'BOYS':
		case 'AMERICAS TEAM':
		case 'THEBOYS':
		  return 'Dallas';
	 	case 'BRONCOS':
		case 'DENVER':
		case 'DENVER BRONCOS':
		  return 'Denver';
		case 'LIONS':
		case 'DETROIT':
		case 'MICHIGAN':
		case 'DETROIT LIONS':
		  return 'Detroit';
		case 'GREEN BAY':
		case 'GREEN BAY PACKERS':
		case 'PACKERS':
		case 'PACK':
		  return 'Green Bay';
		case 'HOUSTON':
		case 'TEXANS':
		case 'HOUSTON TEXANS':
		  return 'Houston';
		case 'INDIANAPOLIS':
		case 'COLTS':
		case 'INDIANAPOLIS COLTS':
		  return 'Indianapolis';
		case 'JACKSONVILLE':
		case 'JAGUARS':
		case 'JACKSONVILLE JAGUARS':
		  return 'Jacksonville';
		case 'KANSAS CITY':
		case 'CHIEFS':
		case 'KANSAS CITY CHIEFS':
		  return 'Kansas City';
		case 'MIAMI':
		case 'DOLPHINS':
		case 'MIAMI DOLPHINS':
		  return 'Miami';
		case 'MINNESOTA':
		case 'VIKINGS':
		case 'MINNESOTA VIKINGS':
		  return 'Minnesota';
		case 'NEW ENGLAND':
		case 'PATRIOTS':
		case 'NEW ENGLAND PATRIOTS':
		  return 'New England';
		case 'NEW ORLEANS':
		case 'SAINTS':
		case 'STS':
		case 'NEW ORLEANS SAINTS':
		  return 'New Orleans';
		case 'NEW YORK':
		case 'GIANTS':
		case 'NEW YORK GIANTS':
		case 'NY GIANTS':
		  return 'Giants';
		case 'JETS':
		case 'NEW YORK JETS':
		case 'NY JETS':
		  return 'Jets';
		case 'OAKLAND':
		case 'RAIDERS':
		case 'OAKLAND RAIDERS':
		  return 'Oakland';
		case 'PHILADELPHIA':
		case 'EAGLES':
		case 'PHILADELPHIA EAGLES':
		  return 'Philadelphia';
		case 'PITTSBURGH':
		case 'STEELERS':
		case 'PITTSBURGH STEELERS':
		  return 'Pittsburgh';
		case 'SAN DIEGO':
		case 'CHARGERS':
		case 'SAN DIEGO CHARGERS':
		  return 'San Diego';
		case 'SAN FRANCISCO':
		case 'SAN FRANCISCO 49ERS':
		case '49ers':
		case 'FORTY NINERS':
		case 'FORTYNINERS':
		case '49 ERS':
		  return 'San Francisco';
		case 'SEATTLE':
		case 'SEAHAWKS':
		case 'SEATTLE SEAHAWKS':
		  return 'Seattle';
		case 'ST LOUIS':
		case 'CARDINALS':
		case 'ST LOUIS CARDINALS':
		case 'CARDS':
		  return 'Cardinals';
		case 'TAMPA BAY':
		case 'TAMPA BAY BUCCANEERS':
		case 'BUCCANEERS':
		  return 'Tampa Bay';
		case 'TENNESSEE':
		case 'TITANS':
		case 'TENNESSEE TITANS':
		  return 'Tennessee';
		case 'WASHINGTON':
		case 'REDSKINS':
		case 'SKINS':
		case 'WASHINGTON REDSKINS':
		  return 'Washington';
		default:
		  return '';
	    }
	  }
 

	  $off_team=team_name($off_team);
	  $def_team=team_name($def_team);

	print "<p> $off_team . $def_team . $play </p>";
 
	  if ($play && $off_team && $def_team) {
	    $stmt = 'select ot.day, ot.quarter, ot.team, dt.nickname, ot.play from ( select t.city as city, t.nickname as team, p.description as play, p.defense_team as defense, p.game_date as day, p.quarter as quarter from ( select * from teams where city like \'%' . $off_team . '%\' or nickname like \'%' . $off_team . '%\') t left outer join plays p on p.offense_team = t.team_name) ot right outer join ( select * from teams where city like \'%' . $def_team . '%\' or nickname like \'%' . $def_team . '%\') dt on ot.defense = dt.team_name where ot.play like \'%' . $play . '%\'';
	  } elseif ($off_team && $play) {
	    $stmt = 'select ot.day, ot.quarter, ot.team, dt.nickname, ot.play from ( select t.city as city, t.nickname as team, p.description as play, p.defense_team as defense, p.game_date as day, p.quarter as quarter from ( select * from teams where city like \'%' . $off_team . '%\' or nickname like \'%' . $off_team . '%\') t left outer join plays p on p.offense_team = t.team_name) ot right outer join ( select * from teams) dt on ot.defense = dt.team_name where ot.play like \'%' . $play . '%\'';
	  } elseif ($def_team && $play) {
	    $stmt = 'select ot.day, ot.quarter, ot.team, dt.nickname, ot.play from ( select t.city as city, t.nickname as team, p.description as play, p.defense_team as defense, p.game_date as day, p.quarter as quarter from ( select * from teams) t left outer join plays p on p.offense_team = t.team_name) ot right outer join ( select * from teams where city like \'%' . $def_team . '%\' or nickname like \'%' . $def_team . '%\') dt on ot.defense = dt.team_name where ot.play like \'%' . $play . '%\'';
	  } elseif ($off_team && $def_team) {
	    $stmt = 'select ot.day, ot.quarter, ot.team, dt.nickname, ot.play from ( select t.city as city, t.nickname as team, p.description as play, p.defense_team as defense, p.game_date as day, p.quarter as quarter from ( select * from teams where city like \'%' . $off_team . '%\' or nickname like \'%' . $off_team . '%\') t left outer join plays p on p.offense_team = t.team_name) ot right outer join ( select * from teams where city like \'%' . $def_team . '%\' or nickname like \'%' . $def_team . '%\') dt on ot.defense = dt.team_name';
	  } elseif ($play) {
	    $stmt = 'select ot.day, ot.quarter, ot.team, dt.nickname, ot.play from ( select t.city as city, t.nickname as team, p.description as play, p.defense_team as defense, p.game_date as day, p.quarter as quarter from ( select * from teams ) t left outer join plays p on p.offense_team = t.team_name) ot right outer join ( select * from teams) dt on ot.defense = dt.team_name where ot.play like \'%' . $play . '%\'';
	  } elseif ($off_team) {
	    $stmt = 'select ot.day, ot.quarter, ot.team, dt.nickname, ot.play from ( select t.city as city, t.nickname as team, p.description as play, p.defense_team as defense, p.game_date as day, p.quarter as quarter from ( select * from teams where city like \'%' . $off_team . '%\' or nickname like \'%' . $off_team . '%\') t left outer join plays p on p.offense_team = t.team_name) ot left outer join ( select * from teams) dt on ot.defense = dt.team_name';
	  } elseif ($def_team) {
	    $stmt = 'select ot.day, ot.quarter, ot.team, dt.nickname, ot.play from ( select t.city as city, t.nickname as team, p.description as play, p.defense_team as defense, p.game_date as day, p.quarter as quarter from ( select * from teams) t left outer join plays p on p.offense_team = t.team_name) ot right outer join ( select * from teams where city like \'%' . $def_team . '%\' or nickname like \'%' . $def_team . '%\') dt on ot.defense = dt.team_name';
	  } else {
	    $stmt = 'select ot.day, ot.quarter, ot.team, dt.nickname, ot.play from ( select t.city as city, t.nickname as team, p.description as play, p.defense_team as defense, p.game_date as day, p.quarter as quarter from ( select * from teams) t left outer join plays p on p.offense_team = t.team_name) ot right outer join ( select * from teams) dt on ot.defense = dt.team_name';
	  }

	  $query = oci_parse($conn, $stmt);
	  oci_execute($query);


	while ($row=oci_fetch_array($query)) {
		print "<tr><td>Date: </td><td>$row[0]</td></tr><br>";
		print "<tr><td>Quarter: </td><td>$row[1]</td></tr><br>";
		print "<tr><td>Offense: </td><td>$row[2]</td></tr><br>";
		print "<tr><td>Defense: </td><td>$row[3]</td></tr><br>";
		print "<tr><td>Description: </td><td>$row[4]</td></tr><br>";
		print "<br><br>";
	  }
	?>
      </div>
      <?php
        echo $tablesHtml;
      ?>
    </div>
  </div><script src="bower_components/jquery/dist/jquery.min.js" type=
  "text/javascript">
</script><script src="bower_components/foundation/js/foundation.min.js"
  type="text/javascript">
</script>
<script src="js/app.js" type="text/javascript"></script>
<script src="js/display.js" type="text/javascript"></script>
</body>
</html>
