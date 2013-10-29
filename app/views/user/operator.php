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
    <?php require_once "../template/header.php"; ?>
  </div>
  <!-- Top Ends -->
  
  <!-- Blog starts -->
  <div class="blog">
    <div class="container">
      <div class="row">
        
        <div class="col-md-7 col-sm-7">
          <div class="posts">
            
            <h3 style="margin-top: 13px; font-size: 34px;">
			  <font style="text-transform: capitalize;">
                <?php echo $_SESSION['name']." ".$_SESSION['surname'] ?>
			  </font>
            <h3>
			
            <h4 style="margin-top: -5px;">
			  <font style="text-transform: capitalize;">
			    <?php echo $mod; ?>
			  </font>
			</h4>
            
            <div class="post-content">
            </div><hr>
            
            <h4 class="actual-turn-module">Turno actual: 65</h4>
            
            <div class="info-module info-module-first"><strong>Nombre:</strong>  <font style="text-transform: capitalize;">fapencio restrepo</font></div>
            <div class="info-module"><strong>e-mail:</strong>  fapencito@gmail.com</div>
            <div class="info-module"><strong>Documento de identidad:</strong>  1017344878</div>
            <div class="info-module"><strong>&iquest;Estudiante de EAFIT&#63;</strong>  No</div>
            <div class="info-module"><strong>Tr&aacute;mite:</strong>  Informaci&oacute;n acerca del tr&aacute;mite</div><br>
            <button type="button" class="btn btn-danger" id="register-admin">El usuario no se present&oacute;</button>&nbsp;
            <button type="button" class="btn btn-primary" id="register-admin">Siguiente turno</button>
            
          </div>
        </div>
        
        <div class="col-md-5 col-sm-5 col-xs-5">
          <div class="sidebar well">
            <div class="widget">
              <h3>Pr&oacute;ximos usuarios a ser atendidos</h3>
              <ul>
                <li><b><font style="text-transform: capitalize;">Fulanito jaramillo</font></b><br><br>
                  <b>Turno:</b> 66<br>
                  <b>Identificaci&oacute;n:</b> 1017347869<br>
                  <b>e-mail:</b> pp@eafit.edu.co<br>
                  <b>&iquest;Estudiante de EAFIT&#63;</b> S&iacute;<br><br>
                  <b>Tr&aacute;mite:</b><br> mi seleccion de horario no se esta mostrando en la plataforma de Ulises, tambien quisiera saber si el certificado que pedi la semana pasada ya esta listo, y de paso el nombre de la monita que atiende en la taquilla 4.
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
  <script src="../../assets/js/operator.js"></script>
  
</body>	
</html>