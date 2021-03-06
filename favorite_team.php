<!DOCTYPE html>

<html class="no-js" lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
  <meta charset="utf-8">
  <meta name="viewport" content=
  "width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="football.ico">

  <title>Favorite Team Analysis</title>
  <link rel="stylesheet" href="stylesheets/app.css" type="text/css">
  <script src="bower_components/modernizr/modernizr.js" type=
  "text/javascript">
</script>
</head><?php
require('navigation.php')
?>

<body>
  <div class="row">
    <div class="large-12 columns">
      <center>
        <h1><img src="images/football_silhouette.png" style=
        "height:30px;">&#160;Who Should Be Your Favorite Team?</h1>
      </center>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <center>
	Perhaps you've always been a fan of the hometown team.  There may be another team that is better suited to your interests in the game! Use this picker to find the top teams whose tendencies align with your interests.
      </center>
      <div class="panel" id="panel1">
        <center><h3>Run/Pass Ratio</h3></center>
	<div class="row">
	  <div class="large-1 column">Only Run</div>
	  <div class="large-10 column">
	    <div class="range-slider" data-slider data-options="display_selector: #runPassOutput;">
	      <span class="range-slider-handle" role="slider" tabindex="0"></span>
 	      <span class="range-slider-active-segment"></span>
	    </div>
	    <center><span id="runPassOutput"></span>
	  </div>
	  <div class="large-1 column">Only Pass</div>
	</div>
      </div>
      <div class="panel" id="panel2">
        <center><h3>Defensive/Offensive Focused</h3></center>
	<div class="row">
	  <div class="large-1 column"><br>Defense</div>
	  <div class="large-10 column">
	    <div class="range-slider" data-slider data-options="display_selector: #defenseOffenseOutput;">
	      <span class="range-slider-handle" role="slider" tabindex="0"></span>
 	      <span class="range-slider-active-segment"></span>
	    </div>
	    <center><span id="defenseOffenseOutput"></span>
	  </div>
	  <div class="large-1 column"><br>Offense</div>
	</div>
      </div>
      <div class="panel" id="panel3">
        <center><h3>Win Percentage</h3></center>
	<div class="row">
	  <div class="large-1 column"><br>Never</div>
	  <div class="large-10 column">
	    <div class="range-slider" data-slider data-options="display_selector: #winOutput;">
	      <span class="range-slider-handle" role="slider" tabindex="0"></span>
 	      <span class="range-slider-active-segment"></span>
	    </div>
	    <center><span id="winOutput"></span>
	  </div>
	  <div class="large-1 column"><br>Always</div>
	</div>
      </div>

      <center><a class="large button" id="find_team_button">Find My Team!</a></center>
    </div>
  </div><script src="bower_components/jquery/dist/jquery.min.js" type=
  "text/javascript">
</script><script src="bower_components/foundation/js/foundation.min.js"
  type="text/javascript">
</script><script src="js/app.js" type="text/javascript">
</script><script src="js/favorite_team.js" type="text/javascript">
</script>
</body>
</html>
