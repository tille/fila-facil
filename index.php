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
  <meta name="keywords" content="filafácil,filafacil,login,signin,signup,turnos,móvil">
  <meta name="author" content="FilaFácil developments">
  
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
              <h1><a href="#">FilaF&aacute;cil</a></h1>
            </div>
          </div>
          <div class="navigation pull-right">
            <?php if(isset($_SESSION['id'])){ ?>
              <?php if( $_SESSION['rol'] == "admin" ){ ?>
				<a href="app/views/user/admin.php"><i class="icon-user"></i> Perfil</a>
              <?php }else{ ?>
				<a href="app/views/user/operator.php"><i class="icon-user"></i> Perfil</a>
              <?php } ?>
            <?php }else{ ?>
              <!--<a href="#"><i class="icon-home"></i> Inicio</a>-->
            <?php } ?>
			
            <a href="about.html"><i class="icon-info-sign"></i> Informaci&oacute;n</a>
            <?php if(isset($_SESSION['id'])){ ?>
              <a href="app/views/user/logout.php"><i class="icon-signout"></i> Salir</a>
            <?php }else{ ?>
              <a href="app/views/user/login.php"><i class="icon-signin"></i> Iniciar sesi&oacute;n</a>
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
              <h2>Hacemos de tu espera un placer <span class="tblue">.</span></h2>
              <p>Aprovecha al m&aacute;ximo tu tiempo, realiza diferentes actividades mientras esperas tu turno <span class="tblue">.</span></p><br />
              <a href="http://www.youtube.com/watch?v=ZC3lpBti3mE" class="download" target="_blank">
				Conoce tus beneficios  
                <i class="icon-youtube-play"></i>
              </a>
			  
			  <a href="#" class="download">
				Descargar 
                <i class="icon-android tgreen"></i>
              </a>
			  
              
              <!--<div class="applinks">
                <a href="https://www.facebook.com/filafacil" target="_blank"><i class="icon-facebook"></i></a>
                <a href="http://www.youtube.com/user/filafacil" target="_blank"><i class="icon-youtube"></i></a>
                <a href="https://twitter.com/filafacil" target="_blank"><i class="icon-twitter"></i></a>
              </div>-->
			  <div class="sidebar">
				<div class="widget" style="margin: 15px;">
				  <a href="https://www.facebook.com/filafacil" class="facebook"><i class="icon-facebook"></i></a>
				  <a href="https://twitter.com/filafacil" class="twitter"><i class="icon-twitter"></i></a>
				  <a href="https://plus.google.com/101324843636113658328/posts" class="google"><i class="icon-google-plus"></i></a>
				  <a href="http://www.youtube.com/user/filafacil" class="youtube"><i class="icon-youtube"></i></a>
				</div>
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
            <h3>Se adapta a t&iacute;</h3>
            <p>Sabemos lo ocupado que te mantienes, es por eso que nos adaptamos a t&iacute;, olv&iacute;date de las filas largas, las eternas esperas y la incomodidad del d&iacute;a a d&iacute;a.</p>
          </div>
        </div>
      </div>
      
      <hr>
      
      
	  <div class="feature-title text-center">
		<h3>Un sistema para todos</h3>
		<p>Estamos presentes en:</p>
      </div>
      <div class="row">
        <div class="col-md-3  col-xs-6">
          <div class="feature-title text-center">
            <!--<p><i class="icon-android"></i></p>!-->
            <p>Entidades bancarias</p>
            <!--<p>Siempre hay presente tumultos </p>-->
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
          <div class="feature-title text-center">
            <!--<p><i class="icon-apple"></i></p>!-->
            <p>Centros m&eacute;dicos</p>
            <!--<p>Suspendisse vitae mauris aliquet, blandit quam ut, sodales odio amet.</p>-->
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
          <div class="feature-title text-center">
            <!--<p><i class="icon-windows"></i></p>-->
            <p>Atenci&oacute;n univerisitaria</p>
            <!--<p>Mauris lobortis tortor vitae elit tincidunt, et hendrerit ante consectetur.</p>-->
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
          <div class="feature-title text-center">
            <!--<p><i class="icon-linux"></i></p>-->
            <p>Entidades gubernamentales</p>
            <!--<p> Proin venenatis eget risus ac hendrerit.Lorem ipsum dolor sit amet.</p>-->
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
            <h3><span class="text-muted">Cont&aacute;giate de <span class="text-muted tblue"> innovaci&oacute;n</span></span></h3>
            <p class="shot-para">Con tan s&oacute;lo unos datos podr&aacute;s tener la comodidad al alcance de tus manos y pertenecer a la onda del ahorro del tiempo. </p>
            <hr>
            
            <div class="row">
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-check tblue"></i>  Cambiar</h4>
                  <p> Cambiar. </p>
                </div>
              </div>
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-mobile-phone tblue"></i> Cambiar</h4>
                  <p> Cambiar </p>
                </div>
              </div>
            </div>
            <hr>
            <!--<a href="#" class="download"><i class="icon-cloud-download"></i> Download</a-->
          </div>
        </div>
        
      </div>
      <hr>
      <!-- shot1 ends -->
      
      <!-- shot2 -->
      <div class="row">
        <div class="col-md-8">
          <div class="shotcontent">
            <h3><span class="text-muted tblue">F&aacute;cil</span><span class="text-muted"> de usar, no te compliques</span></h3>
            <p class="shot-para">Conocer cu&aacute;ntas personas est&aacute;n en la cola para ser atendidos es una gran ventaja a la hora de pedir un turno, pues puedes hacer un c&aacute;lculo r&aacute;pido y saber en c&uacute;anto tiempo ser&iacute;a tu turno. </p>
            <hr>
            
            <div class="row">
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-check tblue"></i>  Amplio</h4>
                  <p> Ingresa a la secci&oacute;n que desees, echa un vistazo a los turnos en cola y reservar el tuyo. </p>
                </div>
              </div>
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-mobile-phone tblue"></i> Remoto</h4>
                  <p> &iexcl;As&iacute; de f&aacute;cil&#33;, con tan solo presionar un bot&oacute;n estar&aacute;s en la cola de atenci&oacute;n, y lo mejor, &iexcl;desde cualquier lugar&#33; </p>
                </div>
              </div>
            </div>
            <hr>
            <!--<a href="#" class="download"><i class="icon-cloud-download"></i> Download</a>-->
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
            <h3><span class="text-muted">Se <span class="text-muted tblue">ajusta</span> a t&iacute;</span></h3>
            <p class="shot-para">FilaF&aacute;cil se anticipa a tus necesidades. Olv&iacute;date del miedo de perder tu turno. </p> 
            <hr>

            <div class="row">
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-bell tblue"></i> Personalizado</h4>
                  <p> Ajusta la notificaci&oacute;n con la cantidad de turnos de anticipaci&oacute;n que desees. </p>
                </div>
              </div>
              <div class="col-md-6 col-xs-6">
                <div class="shot-content-body">
                  <h4><i class="icon-coffee tblue"></i> Social</h4>
                  <p> Disfruta de tus actividades preferidas en el transcurso de tu espera. </p>
                </div>
              </div>
            </div>
            <hr>
            <!--<a href="#" class="download"><i class="icon-cloud-download"></i> Download</a>-->
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


      <!--<div class="row">
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

          <hr>-->
          <div class="copy text-center">
            &copy; 2013 - <a href="#">FilaF&aacute;cil developments</a><!-- - Designed by <a href="http://responsivewebinc.com/bootstrap-themes">Bootstrap Themes</a>-->
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