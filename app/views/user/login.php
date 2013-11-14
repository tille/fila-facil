<?php 
  ob_start();
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Title here -->
  <title>Ingreso</title>
  <?php require_once "../template/pipeline.php" ?>
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
                <h2>Ingreso <span class="tblue">.</span></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero ends -->
  </div>
  <!-- Top Ends -->
  
  <!-- Contact starts -->
  <div class="contact">
    <div class="container">
      <br><br><br>
      
      <?php
        if( isset($_REQUEST["q"]) && $_REQUEST["q"]=="login-invalid" ){
          echo "
            <div class='alert alert-error manual-alert'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <b>Verifica tu usuario y/o contrase&ntilde;a</b>
            </div>";
        }else if( isset($_REQUEST["cc"]) && isset($_REQUEST["pwd"]) ){
          $user_id = $_REQUEST["cc"];
          $pwd = $_REQUEST["pwd"];
          $url = "http://localhost:8888/ff/services.php?q=login_and_redirect&params=".$user_id.",".$pwd;
          header('Location: '.$url);
        }
      ?>
      
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="formdetails well">
            <form class="form-horizontal" role="form" action="./login.php" method="post">
              <fieldset>
                
                <legend>Ingresar al sistema</legend><br>
                
                <div class="form-group">
                  <label for="inputName" class="col-lg-3 control-label">Identificaci&oacute;n</label>
                  <div class="col-lg-9">
                    <input type="name" class="form-control" name="cc" id="inputName" placeholder="Identificaci&oacute;n">
                  </div>
                </div>
                
                <div class="form-group pwd-login-box">
                  <label for="inputComment" class="col-lg-3 control-label">Contrase&ntilde;a</label>
                  <div class="col-lg-9">
                    <input type="password" class="form-control" name="pwd" id="inputName" placeholder="Contrase&ntilde;a">                
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-lg-offset-3 col-lg-9">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                    <button type="reset" class="btn btn-default">Limpiar</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
        
        <div class="col-md-6 col-sm-6">
          <div class="well">
            
            <fieldset>
              <legend>Informaci&oacute;n</legend>
              <address>
                <strong>&iquest;Qui&eacute;n puede ingresar&#63;</strong><br></br>
                Nuestro portal s&oacute;lo est&aacute; habilitado para permitir el inicio de sesi&oacute;n
                para operarios y administradores.<br><br>
              </address>
            </fieldset>
            
          </div>
        </div>
        
      </div>
    </div>
  </div></br></br></br>
  <!-- contact ends -->
  
  <?php require_once "../template/footer.php" ?>
  
</body>	
</html>