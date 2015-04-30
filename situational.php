<!DOCTYPE html>

<html class="no-js" lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
  <meta charset="utf-8">
  <meta name="viewport" content=
  "width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="football.ico">

  <title>Game Situations</title>
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
        <h1><img src="images/football_silhouette.png" style="height:30px;">&nbsp;Game Situations</h1>
      Time is expiring. Which play should you choose? Different plays have different rates of success at given points in the game. Find the best play for your team right now!
	</center>
    </div>
  </div>

  <div class="row">
    <div class="large-12 columns">
      <div class="panel" id="panel1">
	<h3>Type</h3>
	<select id="selector1">
	  <option value = "">Select</option>
	  <option value = "Pass">Pass</option>
	  <option value = "Run">Run</option>
	</select>
      </div>
      <div class="panel" id="panel2" style="display:none;">
	<h3>Direction</h3>
	<select id="selector2"></select>
       </div>
      <div class="panel" id="panel3" style="display:none;">
	<h3>Quarter</h3>
	<select id="selector3"></select>
      </div>
      <div class="panel" id="panel4" style="display:none;">
	<h3>Down</h3>
	<select id="selector4"></select>
      </div>
      <div class="panel" id="panel5" style="display:none;">
      </div>
      <div class="panel" id="panel6" style="display:none;">
      </div>
    </div>
  </div><script src="bower_components/jquery/dist/jquery.min.js" type=
  "text/javascript">
</script><script src="bower_components/foundation/js/foundation.min.js"
  type="text/javascript">
</script>
<script src="js/app.js" type="text/javascript"></script>
<script src="js/situational.js" type="text/javascript"></script>
</body>
</html>
