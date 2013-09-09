<html>
<head>
  <title>Fila facil</title>
</head>
<body>

  <?php
    $con = mysqli_connect("localhost","root","root","ff_database");
    $name = 'Don reymon';
    $sql = "SELECT * FROM test WHERE name='$name'";
    $result = mysqli_query($con,$sql);
    $datos = mysqli_fetch_array($result);
    echo $datos['name'];
  ?>
  
</body>
</html>