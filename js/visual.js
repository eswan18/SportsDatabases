// Connected to visual.php
$(document).foundation(

//{
  //slider: {
    //on_change: function(){
      // do something wearRect(0, 0, canvas.width, canvas.height);n the value changes           
      
//	 $('#selected_table').html("<p>" +$('#days-off-count').attr('value') +"</p>");
//	 $('#selected_table').show();
//	}
//      }
//}
);

/*$('#myCanvas').hover(function(e) {
  var c = document.getElementById("myCanvas");
  var width = c.offsetWidth;
  var ctx = c.getContext("2d");
  ctx.moveTo(0,0);
  ctx.lineTo(0,300);
  ctx.stroke();

    $('#selected_table').html("<p>" +"Event X: " +event.pageX  +"Event Y: " + event.pageY +"</p><p>" +width +"</p>");
    $('#selected_table').show();
  }
);*/

var testNum = 0;

$('[data-slider]').on('change.fndtn.slider', function(){
var pos = $('#days-off-count').val();

	testNum++;
	var c = document.getElementById("myCanvas");
	var width = c.offsetWidth;
	var height = c.offsetHeight;
	var ctx = c.getContext("2d");

	ctx.clearRect(0, 0, c.width, c.height);
	var img = document.getElementById("field");
	ctx.drawImage(img, 0, 0);
	
	ctx.beginPath();
	ctx.moveTo((width/10)*(pos/10),0);
	ctx.lineTo((width/10)*(pos/10),300);


	ctx.strokeStyle = '#ff0000';

	ctx.stroke();
	
 $('#selected_table').html("<p>Pos: " +pos +"</p><p>Width: " +width  +"</p><p>Calculation: " +((width/10)*(pos/10)) +"</p>");
 $('#selected_table').show();


});
