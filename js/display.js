var last_table_name = "";

$('.table_selector').click(function(e) {
    $('#'+last_table_name).hide();
    var table_name = (this.id) + "_table";
    $('#'+table_name).show();
    last_table_name = table_name;
  }
);
