<?php
session_start();
include 'connect.php';
include 'headern.php';
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
   <div class="title">
        <p>Forgot password</p>
    </div>
      <form action="forgotpassword.php" method="post">
        <div class="frame">
          <div class="table">
            <table>
              <tr>
                <td class="sub">Birth day</td> 
                <td align="center"><input class="box" type="tel" maxlength='8' minlength="8" name="birthday" autocomplete="off" required pattern="^[0-9]+$"></td>
              </tr> 
              <tr>
                <td></td>
                <td class="limitation">✳︎input only Number (e.g. 19990402)<br></td>
              </tr>
              <tr>
                <td><br></td>
              </tr>
              <tr>
                <td><br></td>
              </tr>  
              <tr>
                <td class="sub">Email address</td>  
                <td align="center"><input class="box" type="email" required></td>
              </tr>
              <tr>
                <td></td>
                <td class="limitation">*Input only half-digit alphanumeric,include @ and .</td>
              </tr>
            </table>
          <br>  
          <p><?php echo $errormessage?></p>
          <input class= "button" type="submit" name="submit"value="Submit">
      </form>
        </div>
    <br>    
  <div class="link">
    <a href="login.php" class="link">Go to login</a>
  </div>
</body>
</html>