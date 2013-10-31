<?php 
  ob_start(); 
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <!-- Title here -->
    <title>Acerca de nosotros</title>
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
                <h2>Acerca de nosotros <span class="tblue">.</span></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero ends -->
    </div>
    <!-- Top Ends -->

    <!-- About starts -->
    <div class="about">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p class="aboutpara"><span class="tblue">"</span>FilaF&aacute;cil es un sistema desarrollado por cinco j&oacute;venes que quieren incursionar e innovar en el mundo actual, que han visto las necesidades de &eacute;ste y buscan una nueva soluci&oacute;n que ayude a la sociedad a conllevar su estilo de vida. De esta gran idea surgi&oacute; FilaF&aacute;cil developments, empresa que crea soluciones inform&aacute;ticas al alcance de todos y con un gran impacto social que ayuda a sus clientes en el desarrollo diario de su vida.<span class="tblue">"</span>
            </p>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="query">
              <h3>Misi&oacute;n</h3>
              <hr>
              <p>Establecer de manera efectiva la empresa FilaF&aacute;cil developments con el fin de brindarle a sus clientes soluciones para su vida diaria, que no solo la mejore, sino que la innove al mismo tiempo, creando as&iacute; clientes satisfechos y generando beneficios de agrado y simplicidad en sus tareas diarias, y por consiguiente, en sus vidas.</p>
              <hr>
              <h3>Visi&oacute;n</h3>
              <hr>
              <p>FilaF&aacute;cil developments busca posicionarse en el mercado como una empresa de repercusi&oacute;n social, que impacte y modifique el entorno, optimizando el de todos sus usuarios y clientes, creando innovaci&oacute;n y nuevas formas de pensamiento que correspondan en un futuro a una nueva sociedad sencilla, estable y mejor.</p>
              <hr>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <br><br><br><br>
            <img src="../../assets/images/logo.png" alt="image" class="img-responsive" width="163" height="279"/>
          </div>
        </div>
      </div>
    </div>
    <!-- About ends -->

    <!-- Footer starts -->
    <?php require_once "../template/footer.php" ?>
    <!-- Footer Ends -->
  </body>
</html>