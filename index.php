<html>
<head>
  <title>Fila facil</title>
</head>
<body>

  <?php
      //$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

      $server = "us-cdbr-east-04.cleardb.com";
      $username = "b251ba2fc71a0a";
      $password = "44422efc";
      $db = "heroku_4b016d38f7d5c5b";

      mysql_connect($server, $username, $password);
      mysql_select_db($db);
      
      $name = 'Don reymon';
      $sql = "SELECT * FROM test WHERE name='$name'";
      $result = mysql_query($sql);
      $datos = mysql_fetch_array($result, MYSQL_BOTH);
      echo $datos['name'];
      
  ?>

  <?php
  // mysql://b5xxxxx7:37xxxad@us-cdbr-east.cleardb.com/heroku_xxxxxx?reconnect=true
  //mysql --host=us-cdbr-east.cleardb.com --user=b5xxxxx7 --password=37d8faad --reconnect heroku_xxxxxx < my_dump_file.sql
  
  // DATABASE_URL: mysql://b251ba2fc71a0a:44422efc@us-cdbr-east-04.cleardb.com/heroku_4b016d38f7d5c5b?reconnect=true
  // mysql --host=us-cdbr-east-04.cleardb.com --user=b251ba2fc71a0a --password=44422efc --reconnect heroku_4b016d38f7d5c5b < test.sql

  // $con = mysqli_connect("localhost","root","root","ff_database");
  // $name = 'Don reymon';
  // $sql = "SELECT * FROM test WHERE name='$name'";
  // $result = mysqli_query($con,$sql);
  // $datos = mysqli_fetch_array($result);
  // echo $datos['name'];
  ?>
  
</body>
</html>