$(document).ready(function () {
  var uri = "http://localhost:8888/ff/services.php?q=get_operators";
  
  $.ajax({
    type: "GET",
    url: uri,
  }).done(function( data ) {
    if(data==""){
    }else{
      var operators = data.split("?");
      var online = operators[1].split(",");
      var offline = operators[0].split(",");
      
      var l1 = online.length;
      if(operators[1]=="") l1 = 0;
      var l2 = offline.length;
      if(operators[0]=="") l2 = 0;
      
      for( var i=0; i<l1; i++ ){
        var info = online[i].split(":");
        var name = info[0];
        var mod2 = info[1];
        
        get_turn(mod2, name, function( data, name_r, mod_r ) {
          if(data==-1) data = "--";
          data = data.replace(/"/g, "");
          $(".active-operators").append("<li><b>"+name_r+"</b> - "+mod_r+"<br> Turno actual&nbsp;&nbsp;"+data+"</li>");
        });
      }
      
      for( var i=0; i<l2; i++ ){
        var info = offline[i].split(":");
        var id = info[0];
        var mod = info[1];
        $(".inactive-operators").append("<li><b>"+id+"</b> - "+mod+"</li>");
      }
    }
  });
  
  function get_turn(mod, name_p, callback){
    var board_uri="http://localhost:8888/ff/services.php?q=board_status";
    
    $.ajax({
      type: "GET",
      url: board_uri,
    }).done(function( data ) {
      
      // parsing and getting the callback
      data = data.substr(1,data.length-2);
      var modules = data.split(",");
      
      for( var i=0; i<4; i++ ){
        var temp = modules[i].split(":");
        name = temp[0].substr(1,temp[0].length-2);
        if(name==mod) callback(temp[1], name_p, mod);
      }
    });
  }

});