<?php
session_start();
include 'connect.php';
$errormessage = ""; //initialize error message
$errormessage1 = ""; //initialize error message
$userID = $_SESSION['userID'];
if (isset($_POST["submit"])) {
    $password = $_POST["password"]; // get data of password
    $retypepassword = $_POST["retypepassword"]; // get data of passwordagain

    if ($password != $retypepassword) { // if password and password again is not the same.
        $errormessage1 = "New Password and re-enter password are different. Please input same characters in both password form."; // error message
    } else {
        $sql = "UPDATE userinfo SET Password='$password' WHERE userID='$userID'";
        if ($conn->query($sql) === TRUE) {
        echo "";
        } else {
         echo "1 Error during updating record: " . $conn->error . "<br>";
        }
        header("Location:login.php");
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Page - Change Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="changepassword.css">
</head>
<body>
    <div class="header">
      <div class="logo">
        <img src="image/champulogo.png" width="80px" height="50px" alt="champulogo">
         <p>CHAMPU</p>
     </div>
  </div>
    <div class="top"></div>
    <div class="title">
        <p class="page">Change Password</p>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="fram">
        <div class="table">
            <table>
                <tr>
                    <td colspan="2">
                        <p class="errormsg"> <?php echo $errormessage; ?> </p>
                    </td>
                </tr>
                <tr>
                    <td class="sub">Password</td>  
                    <td align="center">
                        <input class="box" type="password" minlength="6" maxlength="12" autocomplete="off" name="password" size="30" required>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="limitation">✳︎input only half-digit alphanumeric, 6-12 characters</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="errormsg"></p>
                    </td>
                </tr>
                <tr>
                    <td class="sub">Password again</td> 
                    <td align="left">
                        <input class="box" type="password" minlength="6" maxlength="12" autocomplete="off" name="retypepassword" size="30" required>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="limitation">✳︎input only half-digit alphanumeric, 6-12 characters</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="errormsg"> <?php echo $errormessage1; ?> </p>
                    </td>
                </tr>                
            </table>
        </div>
        <br><br>
        <p><input class="register" type="submit" value="Submit" title="Change Password" name="submit"></p>
        <br><br>
        <p class="have"><a href='mypage.php'>Back to my page</a></p>
    </div>
    </form>
</body>
</html>