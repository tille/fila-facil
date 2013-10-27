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
              
              <?php require_once "form_admin.php" ?>
              
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
                <li><b>Otro mansito</b> - Certificados</li>
                <li><b>El precoz</b> - Caja</li>
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