<?php ob_start(); ?>
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
            
            <h3><a href="#">Agregar operarios</a></h3>
            <div class="post-content">
              
              <form class="form-horizontal" role="form" action="./login.php" method="post"><br><br>
                <fieldset>

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
                      <button type="submit" class="btn btn-primary">Iniciar</button>
                      <button type="submit" class="btn btn-default">Limpiar</button>
                    </div>
                  </div>
                </fieldset>
              </form>
              
            </div><hr>
            
          </div>
        </div>
        
        <div class="col-md-5 col-sm-5 col-xs-5">
          <div class="sidebar well">
            <div class="widget">
              <h3>Operarios activos</h3>
              <ul>
                <li><b>Fulanito Perez</b> - Admisiones<br> Turno actual: 65</li>
                <li><b>Joaquin Alonso</b> - Caja<br> Turno actual: 34</li>
                <li><b>Simelomon tolomeo</b> - Certificados<br> Turno actual: 02</li>
              </ul>
            </div><br>
            
            <div class="widget" style="">
              <h3>Operarios inactivos</h3>
              <ul>
                <li><b>tales alberto</b> - admisiones</li>
                <li><b>bajaj mamaj</b> - caja</li>
                <li><b>bartomeleo cadavid</b> - cartera</li>
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