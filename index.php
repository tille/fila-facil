<?php 
  ob_start(); 
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Title here -->
  <title>FilaF&aacute;cil</title>
  <!-- Description, Keywords and Author -->
  <meta name="description" content="Login page to filafacil.com">
  <meta name="keywords" content="filafacil,login,signin,signup">
  <meta name="author" content="filafacil developers">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>

  <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic' rel='stylesheet' type='text/css'>


  <!-- Styles -->
  <!-- Bootstrap CSS -->
  <link href="app/assets/stylesheets/bootstrap.min.css" rel="stylesheet">
  <!-- Font awesome CSS -->
  <link href="app/assets/stylesheets/font-awesome.min.css" rel="stylesheet">		
  <!-- Custom CSS -->
  <link href="app/assets/stylesheets/style.css" rel="stylesheet">

  <!-- Favicon -->
  <link rel="shortcut icon" href="#">
</head>

<body>
  
  <!-- Top Starts -->
  <div class="top">
    
    <!-- Header Starts -->
    <header>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="logo">
              <h1><a href="#">FilaF&aacute;cil <span class="tblue">.</span></a></h1>
            </div>
          </div>
          <div class="navigation pull-right">
            <a href="index.html">Inicio</a>
            <a href="about.html">Informaci&oacute;n</a>
            <?php if(isset($_SESSION['id'])){ ?>
              <a href="app/views/user/logout.php">Cerrar session</a>
            <?php }else{ ?>
              <a href="app/views/user/login.php">Iniciar session</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </header>
    <!-- Header Ends -->

    <!-- Hero starts -->
    <div class="hero">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="intro">
              <h2>haz de tu espera un placer <span class="tblue">.</span></h2>
              <p>Reproduce el video que creamos para ti y enterate de lo que filaf&aacute;cil puede hacer por ti. </p><br />
              <a href="#" class="download"><i class="icon-cloud-download"></i> Reproducir</a> <strong></strong>
              <div class="applinks">
                <a href="#"><i class="icon-facebook"></i></a>
                <a href="#"><i class="icon-youtube"></i></a>
                <a href="#"><i class="icon-twitter"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="shot">
              <img src="app/assets/images/phone1.png" alt="image" class="img-responsive"/>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Hero ends -->
  </div>
  <!-- Top Ends -->

  <!-- Feature Starts -->
  <div class="features">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="feature-title text-center">
            <h3>Caracteristicas</h3>
            <p>Descarga nuestra aplicacion y reserva gratuitamente turnos desde tu movil.</p>
          </div>
        </div>
      </div>

      <hr>


      <div class="row">
        <div class="col-md-3  col-xs-6">
          <div class="feat">
            <p><i class="icon-android"></i></p>
            <h4>Entidades Bancarias</h4>
            <p>Aliquam id nulla ac risus condimentum ornare.Lorem ipsum dolor sit amet.</p>
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
          <div class="feat">
            <p><i class="icon-apple"></i></p>
            <h4>Centros medicos - EPS</h4>
            <p>Suspendisse vitae mauris aliquet, blandit quam ut, sodales odio amet.</p>
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
          <div class="feat">
            <p><i class="icon-windows"></i></p>
            <h4>Atenci&oacute;n Univerisitaria</h4>
            <p>Mauris lobortis tortor vitae elit tincidunt, et hendrerit ante consectetur.</p>
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
          <div class="feat">
            <p><i class="icon-linux"></i></p>
            <h4>Notarias</h4>
            <p> Proin venenatis eget risus ac hendrerit.Lorem ipsum dolor sit amet.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Feature Ends -->

  <!-- Shots starts -->
  <div class="shots">
    <div class="container">
      <!-- shot1-->
      <div class="row">
        <div class="col-md-4">
          <div class="screenshot">
            <img src="app/assets/images/f2.png" alt="image" class="img-responsive"/>
          </div>
        </div>
        <div class="col-md-8">
          <div class="shotcontent">
            <h3>Praesent Tincidunt <span class="text-muted"> Tellus Augue</span></h3>
            <p class="shot-para">Dapibus vitae velit. Pellentesque vel venenatis leo, vel egestas velit.In ullamcorper dolor ut odio facilisis tempus. Duis id erat erat. </p> 
            <hr>

            <div class="row">
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-cloud tblue"></i> Envelope</h4>
                  <p> Cras tincidunt ligula orci, ac sodales urna tincidunt eu. Nullam lacinia placerat justo. </p>
                </div>
              </div>
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-camera tblue"></i> Facebook</h4>
                  <p> Praesent tincidunt tellus augue, a tempor massa iaculis non. Phasellus et mi ante. </p>
                </div>
              </div>
            </div>
            <hr>
            <a href="#" class="download"><i class="icon-cloud-download"></i> Download</a>
          </div>
        </div>

      </div>
      <hr>
      <!-- shot1 ends -->

      <!-- shot2 -->
      <div class="row">
        <div class="col-md-8">
          <div class="shotcontent">
            <h3>Vivamus Sed <span class="text-muted">Fringilla Tellus Tellus</span></h3>
            <p class="shot-para">Dapibus vitae velit. Pellentesque vel venenatis leo, vel egestas velit.In ullamcorper dolor ut odio facilisis tempus. Duis id erat erat. </p> 
            <hr>

            <div class="row">
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-linux tblue"></i> Envelope</h4>
                  <p> Cras tincidunt ligula orci, ac sodales urna tincidunt eu. Nullam lacinia placerat justo. </p>
                </div>
              </div>
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-apple tblue"></i> Facebook</h4>
                  <p> Praesent tincidunt tellus augue, a tempor massa iaculis non. Phasellus et mi ante. </p>
                </div>
              </div>
            </div>
            <hr>
            <a href="#" class="download"><i class="icon-cloud-download"></i> Download</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="screenshot">
            <img src="app/assets/images/f3.png" alt="image" class="img-responsive"/>
          </div>
        </div>
      </div>
      <hr>
      <!-- shot2 ends -->

      <!-- shot3 -->
      <div class="row">
        <div class="col-md-4">
          <div class="screenshot">
            <img src="app/assets/images/f4.png" alt="image" class="img-responsive"/>
          </div>
        </div>
        <div class="col-md-8">
          <div class="shotcontent">
            <h3>Morbi Blandi<span class="text-muted"> Sed Tincidunt.</span></h3>
            <p class="shot-para">Dapibus vitae velit. Pellentesque vel venenatis leo, vel egestas velit.In ullamcorper dolor ut odio facilisis tempus. Duis id erat erat. </p> 
            <hr>

            <div class="row">
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-twitter tblue"></i> Envelope</h4>
                  <p> Cras tincidunt ligula orci, ac sodales urna tincidunt eu. Nullam lacinia placerat justo. </p>
                </div>
              </div>
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-google-plus tblue"></i> Facebook</h4>
                  <p> Praesent tincidunt tellus augue, a tempor massa iaculis non. Phasellus et mi ante. </p>
                </div>
              </div>
            </div>
            <hr>
            <a href="#" class="download"><i class="icon-cloud-download"></i> Download</a>
          </div>
        </div>
      </div>
      <!-- shot3 ends -->
      <hr>
    </div>

  </div>

  <!-- Shots Ends -->	

  <!-- Footer starts -->
  <footer>
    <div class="container">


      <div class="row">
        <div class="col-md-3  col-xs-6">
          <div class="footer-link">
            <h5>Phasellus</h5>
            <a href="#">Nullam pharetra nec</a><br>
            <a href="#">Vulputate vitae</a><br>
            <a href="#">Phasellus</a>
          </div>
        </div>
        <div class="col-md-3  col-xs-6">
          <div class="footer-link">
            <h5>Pulvinar</h5>
            <a href="#">Aliquam nec</a><br>
            <a href="#">Nam pulvinar massa</a><br>
            <a href="#">Maecenas fringilla nec</a>
          </div>
        </div>
        <div class="col-md-3  col-xs-6">
          <div class="footer-link">
            <h5>Commodo</h5>
            <a href="#">Consectetur adipiscing elit</a><br>
            <a href="#">Commodo a fermentum vel</a><br>
            <a href="#">Eleifend neque</a>
          </div>
        </div>
        <div class="col-md-3  col-xs-6">
          <div class="footer-link">
            <h5>Start</h5>
            <a href="#">Pellentesque</a><br>
            <a href="#">Startups</a><br>
            <a href="#">Habitasse platea dictumst</a>
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-md-12">

          <hr>
          <div class="copy text-center">
            &copy; 2013 <a href="#">Fasi</a> - Designed by <a href="http://responsivewebinc.com/bootstrap-themes">Bootstrap Themes</a>
          </div>
        </div>
      </div>

    </div>
  </footer>
  <!-- Footer Ends -->

  <!-- Javascript files -->
  <!-- jQuery -->
  <script src="app/assets/js/jquery.js"></script>
  <!-- Bootstrap JS -->
  <script src="app/assets/js/bootstrap.min.js"></script>
  <!-- Respond JS for IE8 -->
  <script src="app/assets/js/respond.min.js"></script>
  <!-- HTML5 Support for IE -->
  <script src="app/assets/js/html5shiv.js"></script>
  <!-- Custom JS -->
  <script src="app/assets/js/custom.js"></script>
</body>	
</html>