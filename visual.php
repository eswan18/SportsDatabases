<!DOCTYPE html>

<html class="no-js" lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
  <meta charset="utf-8">
  <meta name="viewport" content=
  "width=device-width, initial-scale=1.0">

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
      <div class="panel">
	<canvas style="border:1px solid #000000; width:600px;" class="fgMatt" id="myCanvas">Your Browser Does not Support canvas tag</canvas>
	<img src="http://cdn4.colorlib.com/wp/wp-content/uploads/sites/2/2014/02/Olympic-logo.png" alt="footballfield" id="field" style="display:none;height:100px;width:100px;">

	<!-- Slider -->
	<div class="row">
	  <div class="small-10 columns">
	    <div class="range-slider" data-slider data-options="display_selector: #days-off-count; initial: 28;">
	      <span class="range-slider-handle" role="slider" tabindex="0"></span>
	      <span class="range-slider-active-segment"></span>
	    </div>
	  </div>
	  <div class="small-2 columns">
	    <input type="number" id="days-off-count" value="28" />
	  </div>
	</div>

      </div>
      <div class="panel" id = "selected_table" style = "display:none"> 
	
      </div>
    </div>
  </div>
  <script src="bower_components/jquery/dist/jquery.min.js" type= "text/javascript"></script>
  <script src="bower_components/foundation/js/foundation.min.js" type="text/javascript"></script>
  <script src="js/visual.js" type="text/javascript"></script>

  <!-- <script src="js/vendor/jquery.js"></script>
  <script src="js/foundation/foundation.js"></script>
  <script src="js/foundation/foundation.slider.js"></script>
  Other JS plugins can be included here -->

  <script>
    $(document).foundation();
  </script>

</body>
</html>
