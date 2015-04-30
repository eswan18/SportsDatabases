//On clicking the go button:
$("#find_team_button").click(function(){
  $run_pass = $("#runPassOutput").text();
  $off_def = $("#defenseOffenseOutput").text();
  $win = $("#winOutput").text();
  
  //Create form in order to post data and then redirect:
  var redirectUrl = "favorite_team_result.php";
  var form = $('<form action="' + redirectUrl + '" method="post">' +
  '<input type="hidden" name="run_pass" value="' + $run_pass + '" />' +
  '<input type="hidden" name="def_off" value="' + $off_def + '" />' +
  '<input type="hidden" name="win" value="' + $win + '" />' +
  '</form>');
  $('body').append(form);
  $(form).submit();
});
