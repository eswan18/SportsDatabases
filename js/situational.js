$("#selector1").change(function(){
  $select1 = $("#selector1").val();
  if ($select1 != "") {
    //if the selector is changed, update the next panel and hide the others
    $("#panel2").show();
    $.post("situational_form.php", { select1: $select1 }, function(result) {
	$elements = result.split(";");
	$("#selector2").children().remove();
	$("#selector2").append("<option value=\"\">Select</option>");
	$elements.forEach(function(element) {
	  if (element != "") {
	    $("#selector2").append("<option value=\"" + element + "\">" + element + "</option>");
	  }
	});
      }
    );
    $("#panel3").hide();
    $("#panel4").hide();
    $("#panel5").hide();
    $("#panel6").hide();
  } else {
    //if the selector is changed back to 'Select', hide all panels
    $("#panel2").hide();
    $("#panel3").hide();
    $("#panel4").hide();
    $("#panel5").hide();
    $("#panel6").hide();
  }
});

$("#selector2").change(function(){
  $select1 = $("#selector1").val();
  $select2 = $("#selector2").val();
  if ($select2 != "") {
    //if the selector is changed, update the next panel and hide the others
    $("#panel3").show();
    $.post("situational_form.php", { select1: $select1, select2: $select2 }, function(result) {
      $elements = result.split(";");
      $("#selector3").children().remove();
      $("#selector3").append("<option value=\"\">Select</option>");
      $elements.forEach(function(element) {
	$elementString = element;
	if (element == "5")
	  $elementString = "OT";
	if (element != "") {
	  $("#selector3").append("<option value=\"" + element + "\">" + $elementString + "</option>");
	}
      });
    });
    $("#panel4").hide();
    $("#panel5").hide(); 
    $("#panel6").hide();
  } else {
    //if the selector is changed back to 'Select', hide all panels
    $("#panel3").hide();
    $("#panel4").hide();
    $("#panel5").hide();
    $("#panel6").hide();
  }
});

$("#selector3").change(function(){
  $select1 = $("#selector1").val();
  $select2 = $("#selector2").val();
  $select3 = $("#selector3").val();
  if ($select3 != "") {
    //if the selector is changed, update the next panel and hide the others
    $("#panel4").show();
    $.post("situational_form.php", { select1: $select1, select2: $select2, select3: $select3 }, function(result) {
      $elements = result.split(";");
      $("#selector4").children().remove();
      $("#selector4").append("<option value=\"\">Select</option>");
      $elements.forEach(function(element) {
	if (element != "") {
	  $("#selector4").append("<option value=\"" + element + "\">" + element + "</option>");
	}
      });
    });
    $("#panel5").hide();
    $("#panel6").hide();
  } else {
    //if the selector is changed back to 'Select', hide all panels
    $("#panel4").hide();
    $("#panel5").hide();
    $("#panel6").hide();
  }
});

$("#selector4").change(function(){
  $select1 = $("#selector1").val();
  $select2 = $("#selector2").val();
  $select3 = $("#selector3").val();
  $select4 = $("#selector4").val();
  if ($select4 != "") {
    //if the selector is changed, update the next panel and hide the others
    $("#panel5").show();
    $("#panel6").show();
    $.post("situational_form.php", { select1: $select1, select2: $select2, select3: $select3, select4: $select4 }, function(result) {
      $elements = result.split(";");
      $("#panel5").html("");
      $("#panel5").append("<h4>Average Yards Gained: " + $elements[0] + "</h4>");
      $("#panel5").append("<h4>Chance of Scoring: " + $elements[1] + "%</h4>");
      $("#panel6").html("");
      $beginTable = result.indexOf(";",result.indexOf(";")+1);
      $("#panel6").append(result.substring($beginTable+1));
    });
  } else {
    //if the selector is changed back to 'Select', hide all panels
    $("#panel5").hide();
    $("#panel6").hide();
  }
});
