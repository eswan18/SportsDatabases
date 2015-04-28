$('.table_selector').click(function(e) {
    var hidden_panel = $('#selected_table');
    var value = $(this).attr('value');
    var values = value.split(";");
    hidden_panel.html("Average Gain from Passing <i>" +$(this).attr('id') +"</i>: " + values[0] + " yards<br>Chance of Touchdown: " + values[1] + "%"); 
    hidden_panel.show();
  }
);
