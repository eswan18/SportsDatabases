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
var img = new Image();

img.src = "http://www.wpclipart.com/recreation/sports/football/football_2/football_field.png";//"http://www.conceptdraw.com/solution-park/resource/images/solutions/football/Sport-Football-Horizontal-colored-football-field-Template.png";

var scale = img.height/img.width;	

	testNum++;
	var c = document.getElementById("myCanvas");
	var ctx = c.getContext("2d");

c.height = scale*c.width;

	ctx.clearRect(0, 0, c.width, c.height);
	ctx.drawImage(img, 0, 0, img.width, img.height,
			   0, 0, c.width, c.height);
	
	ctx.beginPath();
	ctx.moveTo(30+(c.width/12.5)*(pos/10),0);
	ctx.lineTo(30+(c.width/12.5)*(pos/10),c.height);
	ctx.lineWidth = 2;

	ctx.strokeStyle = '#ff0000';
	ctx.stroke();
	
 $('#selected_table').html("<p>Pos: " +pos +"</p><p>Width: " +c.width  +"</p><p>Calculation: " +(30+(c.width/12.5)*(pos/10)) +"</p>");
 $('#selected_table').show();


});
