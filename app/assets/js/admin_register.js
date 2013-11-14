$(document).ready(function () {

  function clean(){
    $("#form-admin-id").val("");
    $("#form-admin-name").val("");
    $("#form-admin-surname").val("");
    $("#form-admin-email").val("");
    $("#form-admin-pwd").val("");
    $("#form-admin-module").val("");
  }
  
  $("#register-admin").click(function(){
    var id   = $("#form-admin-id").val();
    var name = $("#form-admin-name").val();
    var surn = $("#form-admin-surname").val();
    var email = $("#form-admin-email").val();
    var pwd = $("#form-admin-pwd").val();
    var mod = $("#form-admin-module").val();
    
    var uri = "http://localhost:8888/ff/services.php?q=register_operator&params="+id+","+name+","+surn+","+email+","+pwd+","+mod;
    
    $.ajax({
      type: "GET",
      url: uri,
    }).done(function( data ) {
      if(data=="1"){
        $(".alert-admin").show();
        clean();
      }else{ 
        $(".hidden-admin-error").show();
        $("#form-admin-pwd").val("");
      }
    });
  });
  
  $("#admin-clean").click(function(){
    clean();
  });
});