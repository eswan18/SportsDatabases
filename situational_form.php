<?php
  $select1 = $_POST['select1'];
  $select2 = $_POST['select2'];
  $select3 = $_POST['select3'];
  $select4 = $_POST['select4'];

  $user = "lcronin";
  $password = "lcronin";
  $connString = "xe";
  $conn = oci_connect($user,$password,$connString)
    or die ("Failed Connection");
  
  if (isset($select4)) {
    #The direction attribute has different names depending on run or pass:
    if ($select1 == "Pass") {
      $keyword = "PASS_TYPE";
    } else if ($select1 == "Run") {
      $keyword = "RUSH_DIRECTION";
    }

    #Create the Query to Get Average Yards Gained and Touchdown Percentage:
    $queryString = 'SELECT ROUND(avg(YARDS),2) as AVG_YARDS, round(sum(is_touchdown)/count(*),4)*100 as TD_PCT FROM plays WHERE ' . $keyword . ' = \'' . $select2 . '\' AND QUARTER = ' . $select3 . ' AND DOWN = ' . $select4 . 'ORDER BY DOWN ASC';
    $query = oci_parse($conn,$queryString);
    oci_execute($query);

    #Get the Results:
    $keyword1 = 'AVG_YARDS';
    $keyword2 = 'TD_PCT';
    while (oci_fetch($query)) {
      $currentResult = oci_result($query,$keyword1);
      echo $currentResult . ";";
      $currentResult = oci_result($query,$keyword2);
      echo $currentResult . ";";
    }
    
    #Create the Query to Get the Whole Table:
    $queryString = 'SELECT * FROM plays WHERE ' . $keyword . ' = \'' . $select2 . '\' AND QUARTER = ' . $select3 . ' AND DOWN = ' . $select4;
    $query = oci_parse($conn,$queryString);
    oci_execute($query);

    #Create the table of all plays fitting the given description:
    $returnString = "<div style=\"overflow:scroll;\"><table style=\"width:100%;\">";
    #First, get and print column headers:
    $returnString .= "<tr>";
    for ($i = 1; $i <= oci_num_fields($query); $i++) {
      $returnString .= "<td>" . oci_field_name($query, $i) . "</td>";
    }
    $returnString .= "</tr>";
    #Then, get the rest of the results and print them in the table:
    $count = 0;
    while($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS)) {
      $returnString .= "<tr>";
      foreach ($row as $item) {
	$returnString .= "<td>" . $item . "</td>";
      }
      $returnString .= "</tr>";
      $count += 1;
    }
    $returnString .= "</table></div>";
    echo "<h3>" . $count . " rows matching this description</h3>";
    echo "<h4>Scroll right for more columns</h4><br>";
    echo $returnString;

  #For when the user has selected from the third menu:
  } else if (isset($select3)) {
    #The direction attribute has different names depending on run or pass:
    if ($select1 == "Pass") {
      $keyword = "PASS_TYPE";
    } else if ($select1 == "Run") {
      $keyword = "RUSH_DIRECTION";
    }
    $queryString = 'SELECT UNIQUE DOWN FROM plays WHERE ' . $keyword . ' = \'' . $select2 . '\' AND QUARTER = ' . $select3 . 'ORDER BY DOWN ASC';
    $query = oci_parse($conn,$queryString);
    oci_execute($query);

    $keyword = 'DOWN';
    while (oci_fetch($query)) {
      $currentResult = oci_result($query,$keyword);
      if ($currentResult) {
	echo $currentResult . ";";
      }
    }

  #For when the user has selected from the second menu:
  } else if (isset($select2)) {
    #The direction attribute has different names depending on run or pass:
    if ($select1 == "Pass") {
      $keyword = "PASS_TYPE";
    } else if ($select1 == "Run") {
      $keyword = "RUSH_DIRECTION";
    }

    #create the query:
    $queryString = 'SELECT UNIQUE QUARTER FROM plays WHERE ' . $keyword . ' = \'' . $select2 . '\' ORDER BY QUARTER ASC';
    $query = oci_parse($conn,$queryString);
    oci_execute($query);
    #get the results and print them:
    $keyword = 'QUARTER';
    while (oci_fetch($query)) {
      $currentResult = oci_result($query,$keyword);
      if ($currentResult) {
	echo $currentResult . ";";
      }
    }

  #For when the user has selected from the first menu:
  } else if (isset($select1)) {
    #The direction attribute has different names depending on run or pass:
    if ($select1 == "Pass") {
      $keyword = "PASS_TYPE";
    }
    if ($select1 == "Run") {
      $keyword = "RUSH_DIRECTION";
    }

    #create the query:
    $query = oci_parse($conn, 'SELECT UNIQUE ' . $keyword . ' FROM plays');
    oci_execute($query);
    #get the results and print them:
    while (oci_fetch($query)) {
      $currentResult = oci_result($query,$keyword);
      if ($currentResult) {
	echo $currentResult . ";";
      }
    }
  }

?>
