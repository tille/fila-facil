$(document).ready(function () {
  
  var mod = $("#mod_operator").text();
  get_turn(mod, set_turn);
  
  function set_turn( data ){
    data = data.replace(/"/g, "");
    $(".actual-turn-module").text("Turno actual: "+data);
    
    get_user(mod, data, fill_info);
  }
  
  function fill_info( user ){
    $p = user.split(":");
    
    $(".name-actual").html("<strong>Nombre:  </strong>"+$p[0]);
    $(".email-actual").html("<strong>Email:  </strong>"+$p[1]);
    $(".id-actual").html("<strong>Documento de identidad:  </strong>"+$p[2]);
    
    $p[3] = ($p[3]=="1")?"Si","No";
    $(".student-actual").html("<strong>&iquest;Es estudiante de Eafit?</strong>"+$p[3]);
    //$(".request-actual")
  }
  
  function get_turn(mod, callback){
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
        if(name==mod) callback( temp[1] );
      }
    });
  }
  
  function get_user(mod, turn, callback){
    var uri="http://localhost:8888/ff/services.php?q=get_user&params="+turn+","+mod;
    
    $.ajax({
      type: "GET",
      url: uri,
    }).done(function( user ) {
      callback( user );
    });
  }
});