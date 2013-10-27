<?php 
  ob_start(); 
  session_start();
  
  // // NOTA: llamar un dao desde una vista?, severo machetazo. (corregir)
  if( !isset($_SESSION['module']) ){
    require_once '../../../db/environment.php';
    require_once '../../../db/DAO/DAO_user.php';
    $mod = DAO_user::DAO_user_module($_SESSION['id']);
  }
  
  if( !isset($_SESSION['rol']) || (isset($_SESSION['rol']) && $_SESSION['rol'] == "admin") ){
    header('Location: '."http://localhost:8888/ff/index.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once "../template/pipeline.php" ?>
</head>

<body>
  
  <!-- Top Starts -->
  <div class="top">
    <?php require_once "../template/header.php" ?>
  </div>
  <!-- Top Ends -->
  
  <!-- Blog starts -->
  <div class="blog">
    <div class="container">
      <div class="row">
        
        <div class="col-md-7 col-sm-7">
          <div class="posts">
            
            <h3 style="margin-top: 13px; font-size: 34px;"> Manuelito jacobin<h3>
            <h4 style="margin-top: -5px;"><?php echo $mod; ?></h4>
            
            <div class="post-content">
              
              <div class='alert alert-success alert-admin'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <b><center>El usuario ha sido registrado correctamente!</center></b>
              </div>
              <div class='alert alert-error manual-alert hidden-admin-error'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <b><center>El usuario ha sido registrado correctamente!</center></b>
              </div>
              
            </div><hr>
            
            <h4 class="actual-turn-module">Turno actual: 65</h4>
            
            <div class="info-module info-module-first"><strong>Nombre:</strong>&nbsp;&nbsp;fapencio garcia</div>
            <div class="info-module"><strong>email:</strong>&nbsp;&nbsp;fapencito@gmail.com</div>
            <div class="info-module"><strong>Documento de identidad:</strong>&nbsp;&nbsp;1017344878</div>
            <div class="info-module"><strong>&iquest;Es estudiante de Eafit?</strong>&nbsp;&nbsp;No</div>
            <div class="info-module"><strong>Tramite:</strong>&nbsp;&nbsp;Informacion acerca del tramite</div><br>
            <button type="button" class="btn btn-danger" id="register-admin">El usuario no se presento</button>&nbsp;
            <button type="button" class="btn btn-primary" id="register-admin">Siguiente</button>
            
          </div>
        </div>
        
        <div class="col-md-5 col-sm-5 col-xs-5">
          <div class="sidebar well">
            <div class="widget">
              <h3>Proximos usuarios a ser atendidos</h3>
              <ul>
                <li><b>Fulanito Perez</b><br>
                  <b>Turno:</b> 66<br>
                  <b>Identification:</b> 1017347869<br>
                  <b>Email:</b> pp@eafit.edu.co<br>
                  Estudiante Eafitense<br><br>
                  <b>Tramite:</b><br> mi seleccion de horario no se esta mostrando en la plataforma de Ulises, tambien quisiera saber si el certificado que pedi la semana pasada ya esta listo, y de paso el nombre de la monita que atiende en la taquilla 4.
                </li>
              </ul>
            </div><br>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Blog ends -->
  
  <?php require_once "../template/footer.php" ?>
  
</body>	
</html>