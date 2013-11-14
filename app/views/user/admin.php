<?php 
  ob_start(); 
  session_start();
  
  if( !isset($_SESSION['rol']) || (isset($_SESSION['rol']) && $_SESSION['rol'] == "operario") ){
    header('Location: '."http://localhost:8888/ff/index.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Title here -->
  <title>Panel de administraci&oacute;n</title>
  <?php require_once "../template/pipeline.php" ?>
  <!-- Refresh every 1.30 minutes -->
  <meta http-equiv="refresh" content="90"> 
</head>

<body>
  
  <!-- Top Starts -->
  <div class="top">
    <?php require_once "../template/header.php" ?>
    <!-- Hero starts -->
    <div class="hero">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <div class="intro">
                <h2></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero ends -->
  </div>
  <!-- Top Ends -->
  
  <!-- Blog starts -->
  <div class="blog">
    <div class="container">
      <div class="row">
        
        <div class="col-md-7 col-sm-7">
          <div class="posts">
            
            <h3><a href="#">Agregar operarios</a></h3>
            <div class="post-content">
              
              <div class='alert alert-success alert-admin'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <b><center>El usuario ha sido registrado correctamente</center></b>
              </div>
              <div class='alert alert-error manual-alert hidden-admin-error'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <b><center>El usuario no pudo ser registrado,<br> verifica la identificaci&oacute;n y/o dependencia</center></b>
              </div>
              
              <?php require_once "form_admin.php" ?>
              
            </div><hr>
            
          </div>
        </div>
        
        <!-- http://localhost:8888/ff/services.php?q=get_operators -->
        <div class="col-md-5 col-sm-5 col-xs-5">
          <div class="sidebar well">
            <div class="widget">
              <h3>Operarios activos</h3>
              <ul class="active-operators">
              </ul>
            </div>
            
            <div class="widget">
              <h3>Operarios inactivos</h3>
              <ul class="inactive-operators">
              </ul>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Blog ends -->
  
  <?php require_once "../template/footer.php" ?>
  <script src="../../assets/js/load_operators.js"></script>
  
</body>	
</html>