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
	  
	  echo "Search by offense team: ";
	  echo "<form action=\"select_query.php\" method=\"POST\"><input type =\"text\" name=\"off_team\" placeholder=\"Please enter an offense team\">";
	  echo "Search by defense team: ";
	  echo "<input type=\"text\" name=\"def_team\" placeholder=\"Please enter a defense team\">";
	  echo "Search by play description: ";
	  echo "<input type =\"text\" name=\"play_desc\" placeholder=\"Please enter a play description\">";
	  echo "<input class=\"small button\" type=\"submit\" name=\"submit1\"> </form>"
	?>
      </div>
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
