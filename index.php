<html>
<head>
  <title>Fila Facil</title>
  
  <?php include 'config/routes.php'; ?>
  <link href="app/assets/stylesheets/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="app/assets/stylesheets/index.css" rel="stylesheet" media="screen">
  <script src="app/assets/js/jquery.min.js"></script>
</head>
<body>

  <div class="container container-index">
    <div class="row-fluid">

      <div class="span12" style="">
        <center>
          <form action="http://localhost:8888/ff/services.php?q=redirect_to" type="POST">
            
            <img src="app/assets/images/logo.jpg" class="logo-index"><br><br>
            <center>
              <div class="span6 h1-index">
                <h1>Fila Facil</h1><br>
                
                <input type="text" placeholder="C&eacute;dula"><br>
                <input type="text" placeholder="Contrase&ntilde;a"><br>
                <button type="submit" class="btn btn-info submit-index">
                  Iniciar
                </button>
              </div>
            </center>

          </form>
      </div>

    </div>
  </div>

</body>
</html>