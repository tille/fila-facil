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
  <link href="../../assets/stylesheets/bootstrap.min.css" rel="stylesheet">
  <!-- Font awesome CSS -->
  <link href="../../assets/stylesheets/font-awesome.min.css" rel="stylesheet">		
  <!-- Custom CSS -->
  <link href="../../assets/stylesheets/style.css" rel="stylesheet">

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
            <a href="../../../index.html">Inicio</a>
            <a href="about.html">Informaci&oacute;n</a>
            <a href="app/views/user/login.php">Iniciar session</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Header Ends -->

    <!-- Hero starts -->
    <div class="hero inner-page">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="intro">
              <!-- <h2>operarios / administradores <span class="tblue">.</span></h2> -->
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
    <div class="container"><br>
      
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="formdetails well">
            <form class="form-horizontal" role="form">
              <fieldset>
                <legend>Logueate</legend>
                <div class="form-group">
                  <label for="inputName" class="col-lg-3 control-label">Name</label>
                  <div class="col-lg-9">
                    <input type="name" class="form-control" id="inputName" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-3 control-label">Email</label>
                  <div class="col-lg-9">
                    <input type="email" class="form-control" id="inputEmail" placeholder="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputComment" class="col-lg-3 control-label">Comment</label>
                  <div class="col-lg-9">
                    <textarea class="form-control" rows="3"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-offset-3 col-lg-9">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" class="btn btn-default">Reset</button>
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
                <strong>Quien se puede loguear?</strong><br><br>
                Nuestro portal solo se encuentra habilitado para permitir el inicio de session
                para operarios y administradores.<br><br>
                Recuerda que para iniciar session como operario un administrador debe haber habilitado tu cuenta.
                
              </address>
            </fieldset>

          </div>
        </div>
      </div>
    </div>
  </div><br>
  <!-- contact ends -->

  <!-- Footer starts -->
  <footer>
    <div class="container">


      <div class="row">
        <div class="col-md-3 col-xs-6">
          <div class="footer-link">
            <h5>Phasellus</h5>
            <a href="#">Nullam pharetra nec</a><br>
            <a href="#">Vulputate vitae</a><br>
            <a href="#">Phasellus</a>
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
          <div class="footer-link">
            <h5>Pulvinar</h5>
            <a href="#">Aliquam nec</a><br>
            <a href="#">Nam pulvinar massa</a><br>
            <a href="#">Maecenas fringilla nec</a>
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
          <div class="footer-link">
            <h5>Commodo</h5>
            <a href="#">Consectetur adipiscing elit</a><br>
            <a href="#">Commodo a fermentum vel</a><br>
            <a href="#">Eleifend neque</a>
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
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
  <script src="js/jquery.js"></script>
  <!-- Bootstrap JS -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Respond JS for IE8 -->
  <script src="js/respond.min.js"></script>
  <!-- HTML5 Support for IE -->
  <script src="js/html5shiv.js"></script>
  <!-- Custom JS -->
  <script src="js/custom.js"></script>
</body>	
</html>