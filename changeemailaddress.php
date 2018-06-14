<?php 
    session_start();
    include "connect.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>ChangeEmailaddress</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="changeemailaddress.css">
</head>
<body>
  <div class="header">
      <div class="logo">
        <img src="image/champulogo.png" width="80px" height="50px" alt="champulogo">
         <p>CHAMPU</p>
    
     </div>
  </div>
<?php

$userID=$_SESSION["userID"];

if (isset($_POST["submit"])) {
    $email = $_POST["email"];

    $sql="UPDATE userinfo SET Emailaddress='$email' WHERE userID='$userID'";
    if ($conn->query($sql) === TRUE) {
        echo '<script type="text/javascript">
            window.alert(\'Your new email addrss was recorded successfully\');

         </script>';
    } else {
        echo "Error:" .$sql."<br>".$conn->error;
    }
}

?>


    <div class="top"></div>
    <div class="title">
        <p class="page">Change Password</p>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="fram">
        <div class="table">
            <table>
                <tr>
                    <td class="sub">New email addrss</td> 
                    <td align="left">
                        <input class="box" type="email" autocomplete="off" name="email" size="30" required>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="limitation">✳︎input only half-digit alphanumeric, 6-12 characters</td>
                </tr>
                <tr>
                    <td colspan="2">
                    </td>
                </tr>                
            </table>
        </div>
        <br><br>
        <p><input class="register" type="submit" value="Update" title="Change Password" name="submit"></p>
        <br><br>
        <p class="have"><a href='mypage.php'>Back to my page</a></p>
    </div>
    </form>
</body>
</html>