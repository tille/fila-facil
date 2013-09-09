<html>
<head>
  <title>Fila facil</title>
</head>
<body>

  <?php
      $url=parse_url(getenv("CLEARDB_DATABASE_URL"));

      $server = $url["host"];
      $username = $url["user"];
      $password = $url["pass"];
      $db = substr($url["path"],1);

      mysql_connect($server, $username, $password);
      mysql_select_db($db);
      
      $name = 'Don reymon';
      $sql = "SELECT * FROM test WHERE name='$name'";
      $result = mysqli_query($con,$sql);
      $datos = mysqli_fetch_array($result);
      echo $datos['name'];
      
  ?>

  <?php
    // DATABASE_URL: mysql://b251ba2fc71a0a:44422efc@us-cdbr-east-04.cleardb.com/heroku_4b016d38f7d5c5b?reconnect=true

    // $con = mysqli_connect("localhost","root","root","ff_database");
    // $name = 'Don reymon';
    // $sql = "SELECT * FROM test WHERE name='$name'";
    // $result = mysqli_query($con,$sql);
    // $datos = mysqli_fetch_array($result);
    // echo $datos['name'];
  ?>
  
</body>
</html>