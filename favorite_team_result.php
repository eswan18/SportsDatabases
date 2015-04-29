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
    $user_pass = $_POST['run_pass'];
    $user_run = 100 - $user_pass;
    $user_off = $_POST['def_off'];
    $user_def = 100 - $user_off;
    $user_win = $_POST['win'];
    $team = "Miami Dolphins";
    $team_run_pass = 100;
    $team_def_off = 100;
    $team_win = 100;
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
		echo "Run/Pass<br><h4>" . $team_run_pass . "</h4>";
	      ?>
            </div>
            <div class="large-4 columns">
              <?php
		echo "Defense vs Offense Focus<br><h4>" . $team_def . ":" . $team_off . "</h4>";
	      ?>
            </div>
            <div class="large-4 columns">
              <?php
		echo "Win Percentage<br><h4>" . $team_win . "</h4>";
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
		echo "Run:Pass Ratio<br><h4>" . $user_run . ":" . $user_pass . "</h4>";
	      ?>
            </div>
            <div class="large-4 columns">
              <?php
		echo "Defensive:Offensive Focus<br><h4>" . $user_def . ":" . $user_off . "</h4>";
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
