<!DOCTYPE html>

<html class="no-js" lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
  <meta charset="utf-8">
  <meta name="viewport" content=
  "width=device-width, initial-scale=1.0">

  <title>Portal</title>
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
        <h1>Passing Metrics</h1>
      </center>
    </div>
  </div>

  <div class="row">
    <div class="large-10 large-offset-1 columns">
      <div class="panel">
	<?php
	  $user = "lcronin";
	  $password = "lcronin";
	  $connString = "xe";
	  $conn = oci_connect($user,$password,$connString)
	    or die ("Failed Connection");
	  $stid = oci_parse($conn, 'SELECT round(avg(yards),2) as average, round(sum(is_touchdown)/count(pass_type),4)*100 as tdpct, pass_type FROM plays where pass_type is not null group by pass_type order by pass_type');
	  oci_execute($stid);
	  
	  echo "Hello, <i>" . $user . "</i>, welcome to the table interface.<br><br>";
	  echo "These are the directions you can pass:<br>";
	  echo "<table style = \"width:100%;\">";
	  while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
	    echo "<td><a class = \"table_selector\" id = \"" . $row['PASS_TYPE'] . "\" value = \"" .$row['AVERAGE']. ";" . $row['TDPCT'] . "\">" . $row['PASS_TYPE']. "</a></td>";
	    echo "<tr>";
	  }
	  echo "</table>";
	?>

      </div>
      <div class="panel" id = "selected_table" style = "display:none"> 
	
      </div>
    </div>
  </div>
<script src="bower_components/jquery/dist/jquery.min.js" type=
  "text/javascript">
</script><script src="bower_components/foundation/js/foundation.min.js"
  type="text/javascript">
</script><script src="js/app.js" type="text/javascript">
<script src="js/pass_yards.js" type="text/javascript">
</script>
</body>
</html>
