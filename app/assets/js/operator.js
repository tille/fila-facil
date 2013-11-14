$(document).ready(function () {
  
  var mod = $(".mod-operator").val();
  get_turn(mod, set_turn);
  get_turn(mod, set_next_turn);
  
  $("#confirmation-button").click(function(){
    var confirmation_user = $("#confirmation-id").val();
    var confirmation_pwd = $("#confirmation-pwd").val();
    var new_uri = "http://localhost:8888/ff/services.php?q=next_turn_only_user&params={\"mod\": \""+mod+"\"}";
    
    $.ajax({
      type: "GET",
      url: new_uri,
    }).done(function( next_turn) {
      location.reload();
    });
  
  });

  function set_turn( data ){
    data = data.replace(/"/g, "");
    if(data!=-1){
      $(".actual-turn-module").text("Turno actual: "+data);
      get_user(mod, data, fill_info);
    }else{
      $(".actual-turn-module").text("No se han pedido turnos para esta dependencia.");
    }
  }

  function set_next_turn( data ){
    data = data.replace(/"/g, "");
    if(data!=-1){
      var next_turn = parseInt(data)+1;
      $(".next-turn").html("<b>Turno: </b>"+next_turn);
      get_user(mod, next_turn, fill_next_user_info);
    }else{
      $(".next-turn").html("<b>No hay turnos en cola</b>");
    }
  }

  function fill_next_user_info( user ){
    if(user!="Error: Empty response"){
      $p = user.split(":");
      $(".next-user").html("<b>"+$p[0]+"</b>");
      $(".next-id").html("<b>Identificaci&oacute;n: &nbsp;</b>"+$p[2]);
      $(".next-email").html("<b>e-mail: &nbsp;</b>"+$p[1]);
      
      if($p[3]=="1") $student = "Es Estudiante de EAFIT";
      else $student = "No es Estudiante de EAFIT";
      $(".next-student").html("<b>"+$student+"</b>");
      $(".next-request").html("<b>Tramite:</b><br>"+$p[4]);
      
      $
    }
  }
  
  function fill_info( user ){
    if(user!="Error: Empty response"){
      $p = user.split(":");

      $(".name-actual").html("<strong>Nombre: &nbsp;</strong>"+$p[0]);
      $(".email-actual").html("<strong>Email: &nbsp;</strong>"+$p[1]);
      $(".id-actual").html("<strong>Documento de identidad: &nbsp;</strong>"+$p[2]);

      if($p[3]=="1") $student = "Si";
      else $student = "No";
      $(".student-actual").html("<strong>&iquest;Es estudiante de Eafit? &nbsp;</strong>"+$student);
      $(".request-actual").html("<strong>Tramite: &nbsp;</strong>"+$p[4]);
    }
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
        if(name==mod){
          callback( temp[1] );
        }
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