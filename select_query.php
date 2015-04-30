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
	  $off_team=$_POST['off_team'];
	  $def_team=$_POST['def_team'];
	  //preg_replace("/[^a-z]/", '', $play);
	  //preg_replace("/[^a-z]/", '', $team);

	  $play=trim($play);
	  $off_team=trim($off_team);
	  $def_team=trim($def_team);
         
	print "<p> $off_team . $def_team . $play </p>";
 
	  if ($play && $off_team && $def_team) {
print "<p> here </p>";	
	    $stmt = 'select ot.day, ot.quarter, ot.team, dt.nickname, ot.play from ( select t.city as city, t.nickname as team, p.description as play, p.defense_team as defense, p.game_date as day, p.quarter as quarter from ( select * from teams where city like \'%' . $off_team . '%\' or nickname like \'%' . $off_team . '%\') t left outer join plays p on p.offense_team = t.team_name) ot right outer join ( select * from teams where city like \'%' . $def_team . '%\' or nickname like \'%' . $def_team . '%\') dt on ot.defense = dt.team_name where ot.play like \'%' . $play . '%\'';


//    $stmt = 'select * from plays where offense_team like \'%' . $team . '%\' and description like \'%' . $play . '%\'';
	    $query = oci_parse($conn, $stmt);
	    oci_execute($query);
	  }

	while ($row=oci_fetch_array($query)) {
		print "<tr><td>Date: </td><td>$row[1]</td></tr><br>";
		print "<tr><td>Offense: </td><td>$row[5]</td></tr><br>";
		print "<tr><td>Defense: </td><td>$row[6]</td></tr><br>";
		print "<tr><td>Description: </td><td>$row[12]</td></tr><br>";
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
