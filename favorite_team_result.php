<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta name="generator" content="HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      Favorite Team Analysis
    </title>
    <link rel="stylesheet" href="stylesheets/app.css" type="text/css">
    <script src="bower_components/modernizr/modernizr.js" type="text/javascript">
</script>
  </head>
  <?php require('navigation.php') ?>

  <body>
  <?php
    #Receive variables passed in:
    $user_pass = $_POST['run_pass'];
    $user_run = 100 - $user_pass;
    $user_off = $_POST['def_off'];
    $user_def = 100 - $user_off;
    $user_win = $_POST['win'];

    #Rank teams and find best fit:
    #Connect:
    $user = "lcronin";
    $password = "lcronin";
    $conn_string = "xe";
    $conn = oci_connect($user,$password,$conn_string)
      or die ("Failed Connection");

    $query_string = "Select P.OFFENSE_TEAM as TEAM, round((RUSH_COUNT/(PASS_COUNT+RUSH_COUNT)*100)) as RUSH_PCT, round((WIN/(LOSE+WIN))*100) as WIN_PCT, round(((OFFENSE_RANK-DEFENSE_RANK)/32*50)+50) as OFF_FOCUS
      from (
	Select OFFENSE_TEAM, count(*) as PASS_COUNT
	from plays
	where IS_PASS = 1
	group by OFFENSE_TEAM
      ) P,
      (
	Select OFFENSE_TEAM, count(*) as RUSH_COUNT
	from plays
	where IS_RUSH = 1
	group by OFFENSE_TEAM
      ) R,
      teams T, team_efficiency TE
      where P.OFFENSE_TEAM = R.OFFENSE_TEAM
      and T.TEAM_NAME = P.OFFENSE_TEAM
      and T.TEAM_NAME = TE.TEAM"; 
    $query = oci_parse($conn,$query_string);
    oci_execute($query);

    while (oci_fetch($query)) {
      echo oci_result($query,'TEAM') . ": ";
      echo oci_result($query,'RUSH_PCT') . "% rushes. ";
      echo oci_result($query,'WIN_PCT') . "% winning. ";
      echo oci_result($query,'OFF_FOCUS') . "% offense. <br>";
    }

    #Create variables to display to user:
    $team = "Miami Dolphins";
    $team_pass = 100;
    $team_off = 100;
    $team_win = 100;
    $team_run = 100 - $team_pass;
    $team_def = 100 - $team_off;
  ?>
    <div class="row">
      <div class="large-12 columns">
        <center>
          <h1>
            <img src="images/football_silhouette.png" style="height:30px;">&#160;Results
          </h1>
        </center>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <div class="panel" id="panel1">
	  <center><h3>
	    <?php
	      echo "Your New Team: The " . $team;
	    ?>
	  </h3></center>
          <div class="row" style="text-align:center;">
            <div class="large-4 columns">
              <?php
		echo "Run/Pass Ratio<br><h4>" . $team_run . ":" . $team_pass . "</h4>";
	      ?>
            </div>
            <div class="large-4 columns">
              <?php
		echo "Defensive/Offensive Focus<br><h4>" . $team_def . ":" . $team_off . "</h4>";
	      ?>
            </div>
            <div class="large-4 columns">
              <?php
		echo "Win Percentage<br><h4>" . $team_win . "%</h4>";
	      ?>
            </div>
          </div>
        </div>
      </div>
      <div class="large-12 columns">
        <div class="panel" id="panel2">
          <center><h3>Your Chosen Preferences</h3></center>
          <div class="row" style="text-align:center;">
            <div class="large-4 columns">
              <?php
		echo "Run/Pass Ratio<br><h4>" . $user_run . ":" . $user_pass . "</h4>";
	      ?>
            </div>
            <div class="large-4 columns">
              <?php
		echo "Defensive/Offensive Focus<br><h4>" . $user_def . ":" . $user_off . "</h4>";
	      ?>
            </div>
            <div class="large-4 columns">
              <?php
		echo "Win Percentage<br><h4>" . $user_win . "%</h4>";
	      ?>
            </div>
          </div>
        </div>
      </div>
    </div>
<script src="bower_components/jquery/dist/jquery.min.js" type="text/javascript">
</script><script src="bower_components/foundation/js/foundation.min.js" type="text/javascript">
</script><script src="js/app.js" type="text/javascript">
</script><script src="js/favorite_team.js" type="text/javascript">
</script>
  </body>
</html>
