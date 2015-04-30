$(":checkbox").click(function(){
  $elements = this.id.split("_");
  $selector_id = $elements[0] + "_selector";
  if (this.checked)
    $("#" + $selector_id).show();
  else 
    $("#" + $selector_id).hide();
});

$(":radio").click(function(){
  $("#go_button").removeClass("disabled");
  if (this.value == "first_down") {
    $("#togo_checkbox").prop('checked',true);
    $("#togo_selector").show();
    $("#togo_checkbox").prop('disabled',true);
  }
  else
    $("#togo_checkbox").prop('disabled',false);
});

$("#go_button").click(function(){
  if ($(this).hasClass("disabled"))
    alert("You must select either 'First Down' or 'Touchdown' as your goal.");
  else {
    var data = {};
    $(":checkbox").each(function(){
      if (this.checked) {
	$elements = this.id.split("_");
	$key = $elements[0];
	$selector_id = $key + "_selector";
	$value = $("#" + $selector_id).val();
	data[$key] = $value;
      }
    });
    if ($("#first_down_checkbox").is(":checked"))
      data["goal"] = "first_down";
    else
      data["goal"] = "touchdown";
    $.redirectPost("http://www.google.com",data);
  }
});

$.extend(
{
    redirectPost: function(location, args)
    {
        var form = '';
        $.each( args, function( key, value ) {
            form += '<input type="hidden" name="'+key+'" value="'+value+'">';
        });
        $('<form action="'+location+'" method="POST">'+form+'</form>').appendTo('body').submit();
    }
});
