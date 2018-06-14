
<?php
session_start();

include 'connect.php';

$target_dir = "pics/";
$Emailaddress = $_SESSION["Emailaddress"];
$userID = $_SESSION["userID"];

$sql2 = "SELECT * FROM userinfo WHERE userID = $userID";
$result = $conn->query($sql2);

$row = $result->fetch_assoc();

$Picture = $row["Picture"];

if ($Picture == NULL) {
  $Picture = "unknow.png";
}
?>



<!DOCTYPE>

<html>
<head>
    <title></title>
    <link rel="stylesheet" href="header.css">
</head>
<body>
   <div class="top" width="100px">
   	 <div class="middle">
       <img src="image/champulogo.png" width="80px" height="50px" align="left" class="img">
     </div>
     <div class="company">
      <h2 class="logo" style="margin-top: 0px;"> CHAMPU</h2> 
     </div>
     <div class="right">
     	   <a href='mypage.php' ><img src="pics/<?php echo $Picture; ?>" height="60px" width="60px" class="profile" ontouchstart="" ></a>
     </div>
   </div>
</body>
</html>