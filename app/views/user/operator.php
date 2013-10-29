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
              <?php echo $_SESSION['name']." ".$_SESSION['surname'] ?>
            <h3>
            <h4 style="margin-top: -5px;" id="mod_operator"><?php echo $mod; ?></h4>
            
            <div class="post-content">
            </div><hr>
            
            <h4 class="actual-turn-module">Turno actual: 65</h4>
            
            <div class="info-module info-module-first name-actual">
              <strong>Nombre:</strong>&nbsp;&nbsp;fapencio garcia
            </div>
            
            <div class="info-module email-actual">
              <strong>Email:</strong>&nbsp;&nbsp;fapencito@gmail.com
            </div>
            
            <div class="info-module id-actual">
              <strong>Documento de identidad:</strong>&nbsp;&nbsp;1017344878
            </div>
            
            <div class="info-module student-actual">
              <strong>&iquest;Es estudiante de Eafit?</strong>&nbsp;&nbsp;No
            </div>
            
            <div class="info-module request-actual">
              <strong>Tramite:</strong>&nbsp;&nbsp;Informacion acerca del tramite
            </div><br>
            
            <div id="hide-confirmation-form">
              <h4>Confirma tus datos</h4><br>
              <label for="inputComment" class="col-lg-3 control-label">Identificaci&oacute;n</label>
              <input type="name" class="form-control field-confirmation-form" name="id-confirmation" id="confirmation-id" placeholder="Identificai&oacute;n">
              <label for="inputComment" class="col-lg-3 control-label">Contrase&ntilde;a</label>
              <input type="password" class="form-control field-confirmation-form" name="pwd-confirmation" id="confirmation-pwd" placeholder="Contrase&ntilde;a"><br>
              <button type="button" class="btn btn-primary" id="confirmation-button">
                Confirmar y Continuar
              </button>
            </div>
            
            <button type="button" class="btn btn-danger" id="sanction-button">
              El usuario no se presento
            </button>&nbsp;
            <button type="button" class="btn btn-primary" id="call-next-user">
              Siguiente
            </button>
          </div>
        </div>
        
        <div class="col-md-5 col-sm-5 col-xs-5">
          <div class="sidebar well">
            <div class="widget">
              <h3>Proximos usuarios a ser atendidos</h3>
              <ul>
                <li>
                  <div class="next-user"></div>
                  <div class="next-turn"></div>
                  <div class="next-id"></div>
                  <div class="next-email"></div>
                  <div class="next-student"></div><br>
                  <div class="next-request"></div>
                  <!-- <b>Tramite:</b><br> mi seleccion de horario no se esta mostrando en la plataforma de Ulises, tambien quisiera saber si el certificado que pedi la semana pasada ya esta listo, y de paso el nombre de la monita que atiende en la taquilla 4. -->
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