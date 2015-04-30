$(":checkbox").click(function(){
  $id = this.id;
  $elements = this.id.split("_");
  $selector_id = $elements[0] + "_selector";
  if (this.checked)
    $("#" + $selector_id).show();
  else
    $("#" + $selector_id).hide();
});
