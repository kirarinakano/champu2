<?php

$errormessage = ""; //initialize error message
$errormessage1 = ""; //initialize error message

if (isset($_POST["submit"])) {
    $password = $_POST["password"]; // get data of password
    $retypepassword = $_POST["retypepassword"]; // get data of passwordagain

    if ($password!= $retypepassword) { // if password and password again is not the same.
        $errormessage1 = "New Password and re-enter password are different. Please input same characters in both password form."; // error message
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Page - Change Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="mypage_changepassword.css">
</head>
<body>
    <div class="top"></div>
    <div class="title">
        <p class="page">Change Password</p>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="fram">
        <div class="table">
            <table>
                <tr>
                    <td class="sub">Current Password</td> 
                    <td align="center">
                        <input class="box" type="password" minlength="6" maxlength="12" autocomplete="off" name="currentpassword" size="30" required>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="limitation">✳︎input only half-digit alphanumeric, 6-12 characters<br></td>
                </tr>
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
                    <td class="sub">Re-type password</td> 
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