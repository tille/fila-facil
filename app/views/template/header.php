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
        <a href="../../../index.php">Inicio</a>
        <a href="#">Informaci&oacute;n</a>
        <?php if(isset($_SESSION['id'])){ ?>
          <a href="logout.php">Cerrar session</a>
        <?php }else{ ?>
          <a href="login.php">Iniciar session</a>
        <?php } ?>
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
          <br><br><br>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Hero ends -->
