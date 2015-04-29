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

    $query_string = "Select PASS_DIF, OFF_DIF, WIN_DIF, TEAM, abs(PASS_DIF)+abs(OFF_DIF)+abs(WIN_DIF) as TOTAL_DIF, CITY, NICKNAME, PASS_PCT, OFF_FOCUS, WIN_PCT from
      (
	Select PASS_PCT-" . $user_pass . " as PASS_DIF, TEAM, CITY, NICKNAME, PASS_PCT, OFF_FOCUS, WIN_PCT, "
	. "OFF_FOCUS-" . $user_off . " as OFF_DIF, "
	. "WIN_PCT-" . $user_win . " as WIN_DIF
	from (
	  Select P.OFFENSE_TEAM as TEAM, round((PASS_COUNT/(PASS_COUNT+RUSH_COUNT)*100)) as PASS_PCT, round((WIN/(LOSE+WIN))*100) as WIN_PCT, round(((DEFENSE_RANK-OFFENSE_RANK)/32*50)+50) as OFF_FOCUS, CITY, NICKNAME
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
	  and T.TEAM_NAME = TE.TEAM
	)
      )
      order by TOTAL_DIF asc, WIN_DIF asc";
    $query = oci_parse($conn,$query_string);
    oci_execute($query);
    $teams_table = "<table>";
    $teams_table .= "<tr><td><b>Team</b></td><td><b>Run/Pass Ratio</b></td><td><b>Run/Pass Difference</b></td><td><b>Def/Off Focus</b></td><td><b>Def/Off Difference</b></td><td><b>Win Percentage</b></td><td><b>Win Difference</b></td><td><b>Total Difference</b></td><td><b>Match Percentage</b></td></tr>";
    $count = 0;
    while (oci_fetch($query)) {
      if ($count <= 5) {
	$team = oci_result($query,'CITY') . " " . oci_result($query,'NICKNAME');
	$pass_pct = oci_result($query,'PASS_PCT');
	$run_pct = 100 - $pass_pct;
	$pass_dif = oci_result($query,'PASS_DIF');
	$off_focus = oci_result($query,'OFF_FOCUS');
	$def_focus = 100 - $off_focus;
	$off_dif = oci_result($query,'OFF_DIF');
	$win_pct = oci_result($query,'WIN_PCT');
	$win_dif = oci_result($query,'WIN_DIF');
	$total_dif = oci_result($query,'TOTAL_DIF');
	$pct_similar = round((1 - $total_dif / 150) * 100, 2);
	$teams_table .= "<tr><td>" . $team . "</td>";
	$teams_table .= "<td>" . $run_pct . ":" . $pass_pct . "</td>";
	$teams_table .= "<td>" . $pass_dif . "</td>";
	$teams_table .= "<td>" . $def_focus . ":" . $off_focus . "</td>";
	$teams_table .= "<td>" . $off_dif . "</td>";
	$teams_table .= "<td>" . $win_pct . "%</td>";
	$teams_table .= "<td>" . $win_dif . "%</td>";
	$teams_table .= "<td>" . $total_dif . "</td>";
	$teams_table .= "<td>" . $pct_similar . "%</td>";
	$teams_table .= "</tr>\n";
      }
      $count++;
    }
    $teams_table .= "</table>";

    #Run the query again, this time getting only the first row
    #(in order to fetch the best-fit team):
    oci_execute($query);
    oci_fetch($query);
    $team = oci_result($query,'CITY') . " " . oci_result($query,'NICKNAME');
    $team_pass = oci_result($query,'PASS_PCT');
    $team_off = oci_result($query,'OFF_FOCUS');
    $team_win = oci_result($query,'WIN_PCT');
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
      <div class="large-12 columns">
	<div class="panel" id="panel3">
	  <center><h3>Top 5 Teams for You</h3></center><br>
	  <?php
	    echo $teams_table;
	  ?>
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
