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
        <h1>View Tables</h1>
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
	  $stid = oci_parse($conn, 'SELECT table_name FROM user_tables');
	  oci_execute($stid);
	  
	  $tablesHtml = "";
	  echo "Get a view of the data behind the scenes. Select a table to view it.<br><br>";
	  echo "These are the tables available to you:<br>";
	  echo "<table style = \"width:100%;\">";
	  while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
	    foreach ($row as $item) {
	      echo "<td><a class = \"table_selector\" id = \"" . $item . "\">" . $item . "</a></td>";
	      $tablesHtml .= "<div class=\"panel\" id = \"" . $item . "_table\" style = \"display:none\">";
	      $tablesHtml .= $item;
	      $tableQuery = oci_parse($conn, 'SELECT * FROM ' . $item . ' WHERE ROWNUM < 200');
	      oci_execute($tableQuery);
	      $tablesHtml .= "<table>";
	      while ($row2 = oci_fetch_array($tableQuery, OCI_ASSOC+OCI_RETURN_NULLS)) {
		$trimmedRow = array_slice($row2, 0, 10);
		foreach ($trimmedRow as $item2)
		{
		  $tablesHtml .= "<td>" . $item2 . "</td>";
		}
		$tablesHtml .= "<tr>";
	      }
	      $tablesHtml .= "</table></div>";
	    }
	    echo "<tr>";
	  }
	  echo "</table>";
	?>
	Select one to view its first 10 columns and 200 rows.
      </div>
      <?php
	echo $tablesHtml;
      ?>
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
