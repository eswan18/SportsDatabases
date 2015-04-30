<!DOCTYPE html>

<html class="no-js" lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
  <meta charset="utf-8">
  <meta name="viewport" content=
  "width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="football.ico">

  <title>Field Visualization</title>
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
        <h1><img src="images/goalpost_silhouette.png" style="height:30px;">&nbsp;Field Visualization</h1>
      </center>
    </div>
  </div>
  <div class="row">
    <div class="large-10 large-offset-1 columns">
<center>
Set up the play! Select a zone on the field with the sliders below and see which plays and outcomes are most successful from that zone.
</center>
      <div class="panel">
<!-- Begin Form -->
	<form action="visual_results.php" method="post">

	<center><p id='subText'>Location:</p></center>
	<canvas style="width:100%;" id="myCanvas">Your Browser Does not Support canvas tag</canvas>

	<!-- Slider 1 -->
	<div class="row">
	  <div class="small-10 columns">
	    <div class="range-slider" data-slider data-options="display_selector: #days-off-count1; initial: 30; start: 1; end:99;" name="slider1">
	      <span class="range-slider-handle" role="slider" tabindex="0"></span>
	      <span class="range-slider-active-segment"></span>
	    </div>
	  </div>
	  <div class="small-2 columns">
	    <input type="number" id="days-off-count1" name="yards1" value="30" readonly />
	  </div>
	</div>

	<!-- Slider 2 -->
	<div class="row">
	  <div class="small-10 columns">
	    <div class="range-slider" data-slider data-options="display_selector: #days-off-count2; initial: 20; start: 1; end: 99;" name="slider2">
	      <span class="range-slider-handle" role="slider" tabindex="0"></span>
	      <span class="range-slider-active-segment"></span>
	    </div>
	  </div>
	  <div class="small-2 columns">
	    <input type="number" id="days-off-count2" name="yards2" value="20" readonly />
	  </div>
	</div>	
		<center><input class="small button" type="submit" name="submit1"/></center>
	</form>
<!-- End Form -->
      </div>
    </div>
  </div>
  <script src="bower_components/jquery/dist/jquery.min.js" type= "text/javascript"></script>
  <script src="bower_components/foundation/js/foundation.min.js" type="text/javascript"></script>
  <script src="js/visual.js" type="text/javascript"></script>
  <script>
    $(document).foundation();
  </script>

</body>
</html>
