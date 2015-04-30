<!DOCTYPE html>

<html class="no-js" lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
  <meta charset="utf-8">
  <meta name="viewport" content=
  "width=device-width, initial-scale=1.0">

  <title>Best Option Analysis</title>
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
        <h1><img src="images/football_silhouette.png" style="height:30px;">&nbsp;Best Option Analysis</h1>
      </center>
    </div>
  </div>

  <div class="row">
    <div class="large-12 columns">
      <div class="panel" id="panel1">
        <h3>Game Situation</h3><br>
	<div class="row" style="text-align:center;">
	  <div class="large-2 columns">
	    <input type="checkbox" id="quarter_checkbox"/>
	    <h4 style="display:inline-block;">Quarter</h4>
	    <select id="quarter_selector" style="display:none;">
	      <option value = 1>1</option>
	      <option value = 2>2</option>
	      <option value = 3>3</option>
	      <option value = 4>4</option>
	      <option value = 5>OT</option>
	    </select>
	  </div>
	  <div class="large-2 columns">
	    <input type="checkbox" id="down_checkbox"/>
	    <h4 style="display:inline-block;">Down</h4>
	    <select id="down_selector" style="display:none;">
	      <option value = 1>1</option>
	      <option value = 2>2</option>
	      <option value = 3>3</option>
	      <option value = 4>4</option>
	    </select>
	  </div>
	  <div class="large-2 columns">
	    <input type="checkbox" id="togo_checkbox"/>
	    <h4 style="display:inline-block;">To Go</h4>
	    <select id="togo_selector" style="display:none;">
	      <option value = 1>1</option>
	      <option value = 2>2</option>
	      <option value = 3>3</option>
	      <option value = 4>4</option>
	      <option value = 5>5-6</option>
	      <option value = 7>7-8</option>
	      <option value = 9>9-10</option>
	      <option value = 10>10-12</option>
	      <option value = 13>13-15</option>
	      <option value = 16>16-20</option>
	      <option value = 21>21-25</option>
	      <option value = 26>26-30</option>
	      <option value = 30>30+</option>
	    </select>
	  </div>
	  <div class="large-2 columns">
	    <h4>Goal</h4>
	      <input type="radio" name="goal" value = "first_down"> First Down<br>
	      <input type="radio" name="goal" value = "touchdown"> Touchdown<br>
	  </div>
	  <div class="large-4 columns">
	    <a class="expand button disabled" id="go_button">Go!</a>
	  </div>
	</div>
      </div>
      <div class="panel" id="panel2" style="display:none;">
	<h3>Direction</h3>
      </div>
    </div>
  </div><script src="bower_components/jquery/dist/jquery.min.js" type=
  "text/javascript">
</script><script src="bower_components/foundation/js/foundation.min.js"
  type="text/javascript">
</script>
<script src="js/app.js" type="text/javascript"></script>
<script src="js/best_option.js" type="text/javascript"></script>
</body>
</html>
