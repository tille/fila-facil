<html>
<head>
  <link href="app/assets/stylesheets/bootstrap.min.css" rel="stylesheet" media="screen">
  <script src="app/assets/js/jquery.min.js"></script>
  <script src="app/assets/js/temp.js"></script>
</head>
<body><br>

<?php
  include 'app/controllers/turn_controller.php';
  include 'db/environment.php';
  $board = turn_controller::get_board(); 
  $params = json_decode($board);
  $url = 'http://localhost:8888/ff/services.php?q=next_turn&params={"user":1,"pwd":123,"mod":"admisiones"}'; 
?>

  
<div class="container" style="height: auto;">
  <div class="row-fluid">
        
    <div class="span3" style="">    
      <center>
        <b><h3>Admisiones</h3></b>
        <h1 id="admisiones">
          <?php 
            $num = $params->{'admisiones'}; 
            if($num == "-1") echo "-";
            else echo $num;
          ?>
        </h1>
        <button class="btn btn-info" id="next-admisiones">Siguiente turno</button>
      </center>
    </div>
    
    <div class="span3" style="">    
      <center>
        <b><h3>Cartera</h3></b>
        <h1 id="cartera">
          <?php 
            $num = $params->{'cartera'}; 
            if($num == "-1") echo "-";
            else echo $num;
          ?>
        </h1>
        <button class="btn btn-info" id="next-cartera">Siguiente turno</button>
      </center>
    </div>

    <div class="span3" style="">
      <center>
        <b><h3>Caja</h3></b>
        <h1 id="caja">
          <?php 
            $num = $params->{'caja'}; 
            if($num == "-1") echo "-";
            else echo $num;
          ?>
        </h1>
        <button class="btn btn-info" id="next-caja">Siguiente turno</button>
      </center>
    </div>

    <div class="span3" style="">    
      <center>
        <b><h3>Certificados</h3></b>
        <h1 id="certificados">
          <?php 
            $num = $params->{'certificados'}; 
            if($num == "-1") echo "-";
            else echo $num;
          ?>
        </h1>
        <button class="btn btn-info" id="next-certificados">Siguiente turno</button>
      </center>
    </div>
      
  </div>
</body>
</html>