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
	<p>Place main text here</p>
	<?php
		$user = "lcronin";
		$password = "lcronin";
		$connString = "xe";

		$conn = oci_connect($user, $password, $connString)
			or die ("Failed Connection");		

		$yards1 = $_POST['yards1'];
		$yards2 = $_POST['yards2'];

		$yards1 = intval($yards1);
		$yards2 = intval($yards2);

		
		if ($yards1 < $yards2) {
			$yardsLo = $yards1;
			$yardsHi = $yards2;
		}
		else {
			$yardsLo = $yards2;
			$yardsHi = $yards1;
		}

		$stmt = 'select unique yards from plays where yards >= ' .$yardsLo. ' and yards <= ' .$yardsHi. ' order by 1';

		$query = oci_parse($conn, $stmt);
		oci_execute($query);

		while($row=oci_fetch_array($query)) {
			print "<p>$row[0]</p>";
		}

		echo "<p>Query: " .$stmt. "</p>";
		echo "<p>Yards selected:</p><p>High: " .$yardsHi. "</p><p>Low: " .$yardsLo. "</p>";
	?>
      </div>

      <div class="panel" id = "selected_table"> 	
	<p>Yards To Score:</p>
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
