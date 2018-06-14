<?php
session_start();
include 'connect.php';

$errormessage="";

$sql="SELECT * from userinfo";
$result = $conn->query($sql);
  if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
    $Birthday = $row['Birthday'];
    $Email = $row['Emailaddress'];
    }
  }
if(isset($_POST['submit'])) {
  $birthday = $_POST['Birthday'];
  $emailaddress = $_POST['Emailaddress'];
  $sql = "SELECT * from userinfo WHERE Birthday='$Birthday', Emailaddress=$Email";
  $result = $conn->query($sql);
    if ($result->num_rows > 0){
      header("location:changepassword.php");
    } elseif ($result->num_rows == 0) {
      $errormessage = "＊Your birthday or/and email address is wrong.";
    }
}

?>

<!DOCTYPE html1>
<html>
 <head>
  <link rel="stylesheet" href="forgotpassword.css">
</head>
<body>
  <div class="header">
    <div class="logo">
      <img src="image/champulogo.png" width="80px" height="50px" alt="champulogo">
      <p>CHAMPU</p>
    
     </div>
  </div>
  <div class="tittle">
    <p>Forgot password</p>
  </div>
<div class="subtittle">
  <p>BirthDay</p>
  <form action="forgotpassword.php" method="post">
  <input type="date" name="Birthday" required>
    <div class="subtittle">
    <p>Email address</p>
        </div>
         <input type="email" name="Emailaddress" required>
    <div class="caution">
      <p>*Input only half-digit alphanumeric,include @ and .</p>
   </div>
   <p><?php echo $errormessage?>
     
    <input class= "button" type="submit" name="submit"value="Submit">
  </form>
  <div class="link">
    <a href="login.php">Go to login</a>s
  </div>
</body>
</html>

