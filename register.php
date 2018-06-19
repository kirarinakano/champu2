<?php
 include 'connect.php';


if (isset($_POST["submit"])){
$Password = $_POST["Password"];
$repassword = $_POST["repassword"];
$Emailaddress = $_POST['Emailaddress'];
$UserName = $_POST['UserName'];
$Birthday = $_POST['Birthday']; 
} 


$error = 0;

?>



<!DOCTYPE>
<html>
<head>
  <title>register</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <div class="top" width="100px">
    <div class="middle">
        <img src="image/champulogo.png" width="80px" height="50px" align="left" class="img">
    </div>
     <div class="company">
      <h2 class="logo" style="margin-top: 0px;"> CHAMPU</h2> 
  </div>
<!--       <p >Name: <input type="text" name="name" ></p> -->
<!--       <p >Pass:</p> <input type="text" name="pass" ><br> -->
          <div class="title">
            <p class="page"><strong>Sign up</strong></p>
          </div>
      <div class="frame">
        <div class="table">
          <table>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
              <tr>
                  <td class="sub">Username</td> 
                  <td align="center"><input class="box" type="text" maxlength="32" minlength="4" autocomplete="off" name="UserName" required></td>
              
              </tr> 
              <tr>
                  <td></td>
                  <td class="limitation">✳︎input only half-digit alphnumeric, 4-32 characters<br></td>
              </tr>
              <tr>
                  <td class="sub">Email address</td>  
                  <td align="center"><input class="box" type="email" id="email"  autocomplete="off" name="Emailaddress" required></td>
              </tr>
              <tr>
                  <td></td>
                  <td class="limitation">✳︎input only half-digit alpahnumeric, include @ and .</td>
              </tr>
              <tr>
                  <td class="sub">Password</td> 
                  <td align="center"><input class="box" type="password" name="Password" maxlength="12" minlength="6" id="password" required  autocomplete="off" required></td>
              </tr>
              <tr>
                  <td></td>
                  <td class="limitation">✳︎input only half-digit alphanumeric, 6-12 characters</td>
              </tr>
              <tr>
                  <td class="sub">Password again</td> 
                  <td align="center"><input class="box" type="password" maxlength="12" minlength="6" name="repassword" id="password"  autocomplete="off" required></td> 
              </tr>
              <tr>
                  <td></td>
                  <td class="limitation">✳︎input only half-digit alphanumeric, 6-12 characters</td>
              </tr>
              <tr>
                  <td colspan="2" align="right">
                  <?php
                  if(!empty($_POST["Password"]) && ($_POST["Password"] == $_POST["repassword"])) {
                  if (strlen($_POST["Password"]) < '6') {
                  echo "Your Password Must Contain At Least 6 Characters!";
                          $error = 1;
                      }
                  }
                  elseif(empty($_POST["Password"])) {
                      echo "";
                      $error = 1;
                  } else {
                       echo "✳︎Please input same characters in both Password forms." ;
                       $error = 1;
                  }
                  ?>
                  </td>
              </tr>
              <tr>
                  <td class="sub">BirthDay</td>
                  <td align="center"><input class="box" type="tel" maxlength='8' minlength="8" name="Birthday" autocomplete="off" required pattern="^[0-9]+$"></td> 
              </tr>
              <tr>
                  <td></td>
                  <td class="limitation">✳︎input only Number (e.g. 19990402)</td>
              </tr> 
            </table>
        </div>


      <br><br>
        <p><input class="register" type="submit" value="Registrar" title="Register" name="submit"></p>
        <h1>or sign up with Social Network</h1>
        <br><br>
        <a class="f" href="">facebook</a>
        <a href="">twitter</a>

        <p class="have"><a href='login.php'>Have an account</a></p>
            </form>  
    
        </form>
      </div>
</body>
</html>

<?php

if (isset($_POST["submit"])){
 $sql = "INSERT INTO userinfo (userID, Username, Emailaddress, Password, Birthday)
 VALUES ('','$UserName', '$Emailaddress', '$Password', '$Birthday')";

 if ($error != 1 && $conn->query($sql)) {
   header('Location: login.php');
 } 
}


 ?>