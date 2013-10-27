$(document).ready(function () {
  $("#register-admin").click(function(){
    var id   = $("#form-admin-id").val();
    var name = $("#form-admin-name").val();
    var surn = $("#form-admin-surname").val();
    var email = $("#form-admin-email").val();
    var pwd = $("#form-admin-pwd").val();
    var mod = $("#form-admin-module").val();
    
    // http://localhost:8888/ff/services.php?q=register_operator&params={"identification":0,"name":"manolo2","surname":"cardona2","email":"manolo@eafit.edu.co","password":"123","module":admisiones}
    
    alert("identification:"+id+"name"+name+"surname"+surn+"email"+email+"password"+pwd+"module"+mod);
    // $.ajax({
    //   type: "GET",
    //   url: 'http://localhost:8888/ff/services.php?q=register&params={"user":1,"pwd":123,"mod":"admisiones"}',
    // }).done(function( data ) {
    //   if(data=="-1") $("#admisiones").html("-");
    //   else $("#admisiones").html(data);
    // });
  });
});