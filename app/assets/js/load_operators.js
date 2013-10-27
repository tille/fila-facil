$(document).ready(function () {
  var uri = "http://localhost:8888/ff/services.php?q=get_operators";
  
  $.ajax({
    type: "GET",
    url: uri,
  }).done(function( data ) {
    if(data==""){
      alert("no habia nada");
    }else{
      var operators = data.split("?");
      var online = operators[0].split(",");
      var offline = operators[1].split(",");
      
      var l1 = online.length;
      if(operators[0]=="") l1 = 0;
      var l2 = offline.length;
      if(operators[1]=="") l2 = 0;
      
      for( var i=0; i<l1; i++ ){
        var info = online[i].split(":");
        var id = info[0];
        var mod = info[1];
        $(".active-operators").append("<li><b>"+id+"</b> - "+mod+"<br> Turno actual: 65</li>");
      }
      
      for( var i=0; i<l2; i++ ){
        var info = offline[i].split(":");
        var id = info[0];
        var mod = info[1];
        $(".inactive-operators").append("<li><b>"+id+"</b> - "+mod+"<br> Turno actual: 65</li>");
      }
    }
  });

});