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
  <!-- Title here -->
  <title>Panel de operario</title>
  <?php require_once "../template/pipeline.php" ?>
</head>

<body>
  
  <!-- Top Starts -->
  <div class="top">
    <?php require_once "../template/header.php"; ?>
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
            
            <input type="name" class="mod-operator" style="display: none;" value="<?php echo $mod; ?>">

            <div class="post-content">
            </div><hr>
            
            <h4 class="actual-turn-module"></h4>
            
            <div class="info-module info-module-first name-actual">
            </div>
            
            <div class="info-module email-actual">
            </div>
            
            <div class="info-module id-actual">
            </div>
            
            <div style="display: none;" class="user-actual-module">
            </div>
            
            <div class="info-module student-actual">
            </div>
            
            <div class="info-module request-actual">
            </div><br>
            
            
            <button type="button" class="btn btn-danger" id="sanction-button">
              El usuario no se present&oacute;
            </button>&nbsp;
            <button type="button" class="btn btn-primary" id="confirmation-button">
              Siguiente turno
            </button>
          </div>
        </div>
        
        <div class="col-md-5 col-sm-5 col-xs-5">
          <div class="sidebar well">
            <div class="widget">
              <h3>Pr&oacute;ximos usuarios a ser atendidos</h3>
              <ul>
                <li>
                  <div class="next-user"></div>
                  <div class="next-turn"></div>
                  <div class="next-id"></div>
                  <div class="next-email"></div>
                  <div class="next-student"></div><br>
                  <div class="next-request"></div>
                </li>
              </ul>
            </div>
            
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