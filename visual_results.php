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
      <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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

		# -- Field Goals Tried -- #
		$stmtFgTotal = 'select down, count(*)
				from plays
				where yard_line <= ' .$yardsHi.
				' and yard_line >= ' .$yardsLo.
				' and formation=\'FIELD GOAL\'
				and down > 0 group by down order by 1 asc';

		$query = oci_parse($conn, $stmtFgTotal);
		oci_execute($query);

		$result = oci_fetch_array($query);
		$fgTotal[0] = $result[1];

		$result = oci_fetch_array($query);
		$fgTotal[1] = $result[1];
		
		$result = oci_fetch_array($query);
		$fgTotal[2] = $result[1];
		
		$result = oci_fetch_array($query);
		$fgTotal[3] = $result[1];

		# -- Field Goals Made -- #
		$stmtFgMade = 'select down, count(*)
				from plays
				where yard_line <= ' .$yardsHi.
				' and yard_line >= ' .$yardsLo.
				' and formation=\'FIELD GOAL\' 
				and description like \'%IS GOOD%\' 
				and down > 0 group by down order by 1 asc';

		$query = oci_parse($conn, $stmtFgMade);
		oci_execute($query);

		$result = oci_fetch_array($query);
		$fgMade[0] = $result[1];

		$result = oci_fetch_array($query);
		$fgMade[1] = $result[1];
	
		$result = oci_fetch_array($query);
		$fgMade[2] = $result[1];
	
		$result = oci_fetch_array($query);
		$fgMade[3] = $result[1];


		# -- Play Totals -- #
		$stmtTdTotal = 'select down, sum(is_touchdown), sum(is_pass), sum(is_rush), count(*)
				from plays
				where yard_line <= ' .$yardsHi.
				' and yard_line >= ' .$yardsLo.
				' and down > 0 group by down order by 1 asc';
		
		$query = oci_parse($conn, $stmtTdTotal);
		oci_execute($query);

		$i;
		for($i = 0; $i < 4; $i++) {
			$result = oci_fetch_array($query);
			$tdTotal[$i] = $result[1];
			$passTotal[$i] = $result[2];
			$rushTotal[$i] = $result[3];
			$total[$i] = $result[4];
		}
	
		# -- Percentage Total -- #

		for($i = 0; $i < 4; $i++) {
			$passPct[$i] = 0;
			$rushPct[$i] = 0;
			$fgPct[$i] = 0;
			$otherPct[$i] = 0;
			$fgMadePct[$i] = 0;
			$tdPct[$i] = 0;

			if($total[$i] > 0) {
				$passPct[$i] = round($passTotal[$i]/$total[$i]*100, 2);
				$rushPct[$i] = round($rushTotal[$i]/$total[$i]*100, 2);
				$fgPct[$i] = round($fgTotal[$i]/$total[$i]*100, 2);
				$otherPct[$i] = round( 100 - ($passPct[$i] + $rushPct[$i] + $fgPct[$i]), 2 );
				$tdPct[$i] = round($tdTotal[$i]/$total[$i]*100, 2);
			}

			if($fgTotal[$i] > 0) {
				$fgMadePct[$i] = round($fgMade[$i]/$fgTotal[$i]*100, 2);
			}		
		
			echo "<input type='hidden' value='"
				.$passPct[$i].":"
				.$rushPct[$i].":"
				.$fgPct[$i].":"
				.$otherPct[$i].":"
				.$tdPct[$i].":"
				.$fgMadePct[$i].":"
				.$yardsLo.":"
				.$yardsHi.
				"' id='percentages" .$i. "' />";
		}
	?>
      </div>
    </div>
  </div>
  <script src="bower_components/jquery/dist/jquery.min.js" type= "text/javascript"></script>
  <script src="bower_components/foundation/js/foundation.min.js" type="text/javascript"></script>
  <script src="js/visual_results.js" type="text/javascript"></script>

<script src="./charts/js/highcharts.js"></script>
<script src="./charts/js/modules/exporting.js"></script>


  <script>
    $(document).foundation();
  </script>

</body>
</html>
