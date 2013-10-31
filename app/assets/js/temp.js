$(document).ready(function () {
  $("#next-admisiones").click(function(){
    $.ajax({
      type: "GET",
      url: 'http://filafacil.herokuapp.com/services.php?q=next_turn&params={"user":1,"pwd":123,"mod":"admisiones"}',
    }).done(function( data ) {
      if(data=="-1") $("#admisiones").html("-");
      else $("#admisiones").html(data);
    });
  });
  
  $("#next-cartera").click(function(){
    $.ajax({
      type: "GET",
      url: 'http://filafacil.herokuapp.com/services.php?q=next_turn&params={"user":1,"pwd":123,"mod":"cartera"}',
    }).done(function( data ) {
      if(data=="-1") $("#cartera").html("-");
      else $("#cartera").html(data);
    });
  });
  
  
  $("#next-caja").click(function(){
    $.ajax({
      type: "GET",
      url: 'http://filafacil.herokuapp.com/services.php?q=next_turn&params={"user":1,"pwd":123,"mod":"caja"}',
    }).done(function( data ) {
      if(data=="-1") $("#caja").html("-");
      else $("#caja").html(data);
    });
  });
  
  
  $("#next-certificados").click(function(){
    $.ajax({
      type: "GET",
      url: 'http://filafacil.herokuapp.com/services.php?q=next_turn&params={"user":1,"pwd":123,"mod":"certificados"}',
    }).done(function( data ) {
      if(data=="-1") $("#certificados").html("-");
      else $("#certificados").html(data);
    });
  });
  
});