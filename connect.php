<!DOCTYPE>
<html>
  <head>
  
  </head>
  <body>
  <?php
    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $db = "champu";
    
    $conn = mysqli_connect($host, $user, $pass, $db)or
      die("Database connection faild: " .
         mysqli_connect_error());
  ?>
  
  </body>


</html>