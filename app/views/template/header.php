<!-- Header Starts -->
<header>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="logo">
          <h1><a href="../../../index.php">FilaF&aacute;cil</a></h1>
        </div>
      </div>
      <div class="navigation pull-right">
        <a href="../../../index.php"><i class="icon-home"></i> Inicio</a>
        <?php if(isset($_SESSION['id'])){ ?>
          <?php if( $_SESSION['rol'] == "admin" ){ ?>
            <a href="admin.php"><i class="icon-desktop"></i> Panel</a>
          <?php }else{ ?>
            <a href="operator.php"><i class="icon-desktop"></i> Panel</a>
          <?php } ?>
        <?php }?>
        <a href="about.php"><i class="icon-info-sign"></i> Nosotros</a>
        <?php if(isset($_SESSION['id'])){ ?>
          <a href="logout.php"><i class="icon-signout"></i> Salir</a>
        <?php }else{ ?>
          <a href="login.php"><i class="icon-signin"></i> Iniciar sesi&oacute;n</a>
        <?php } ?>
      </div>
    </div>
  </div>
</header>
<!-- Header Ends -->
