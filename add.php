<?php
include 'connect.php';
include 'header.php';
$Emailaddress = $_SESSION["Emailaddress"];
// $userID = 3;
$sql = "SELECT * FROM userinfo LEFT JOIN itemdata ON userinfo.userID = itemdata.userID";
$result = $conn->query($sql);
$sql2 = "SELECT * FROM itemdata LEFT JOIN itemadddata ON itemdata.itemID = itemadddata.itemID";
$result2 = $conn->query($sql2);
$sql6 = "SELECT userID FROM userinfo WHERE Emailaddress='$Emailaddress'";
$result3 = $conn->query($sql6);
if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
          $user = $row["userID"];
          $userID = $user;     
 }}
$errorMessage = "";
if (isset($_POST["itemdata"])) {
  $item = $_POST["Itemname"];
  $amount = $_POST["amount"];
  $startday = $_POST["startday"];
 
  $today = date("Y/m/d");
  if (strtotime($today) < strtotime($startday)) {
      $errorMessage = "The start day should be before or today. Please reselect.";
    } else if (strtotime($today) === strtotime($startday)) {
       $sql1 ="INSERT INTO itemdata (Itemname, Amount,userID)
    VALUES ('$item', '$amount', '$userID') ";
     if ($conn->query($sql1) === TRUE) {
    echo "";
    } else {
    echo "Error:" .$sql1."<br>".$conn->error;
      }
      $sql4 = "SELECT itemID FROM itemdata";
     $result1 = $conn->query($sql4);
     if ($result1->num_rows > 0) {
      while ($row = $result1->fetch_assoc()) {
      $itemID = $row["itemID"];
       }} else {
        echo "0 results";
      }
      $sql3 = "INSERT INTO itemadddata (Startday,itemID) VALUES('$startday','$itemID')";
       if ($conn->query($sql3) === TRUE) {
       echo "";
       header("Location: main.php");
       } else {
        echo "Error:" .$sql3."<br>".$conn->error;
         }
      } else if (strtotime($today) > strtotime($startday)) {
        $sql3 = "INSERT INTO itemadddata (Startday,itemID) VALUES('$startday','$itemID')";
        if ($conn->query($sql3) === TRUE) {
        echo "";
        header("Location: main.php");
        } else {
        echo "Error:" .$sql3."<br>".$conn->error;
        }
      }
  }
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
// header("Location: main.php");
// exit();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="add.css">
  <title>additem</title>
</head>
<body>
  <div class="title">
    <p>Add item</p>
  </div>
  <form action="add.php" method="POST" >
    <div class="frame">  
      <div class="wrap">
      <div class="subtitle">
        <SPAN style="margin-right:230px">
          <p>Item Name</p>
          <p>Amout</p>
        </SPAN>  
      </div>
      <div class="itemdata">
        <SPAN style="margin-right:230px">
          <input type="text" class="itemname" name="Itemname" maxlength="20" minlength="1" required autocomplete="off">
          &ensp;&ensp;&emsp;&emsp;&emsp;
          <input type="number" class="amount" name="amount" min="1" required autocomplete="off"> 
          <span>ml</span>
        </SPAN>
      </div>
      <div class="subtitle">
        <SPAN style="margin-right:500px">
          <p>Use Start Date</p>
        </SPAN>
      </div>
        <SPAN style="margin-right:400px">
          <input type="date" value="" name="startday" class="date" required>
        </SPAN> 
          <?php 
          echo $errorMessage;
          ?>
      </div>
      <br>
      <div class="wrap_register">
        <button type="submit" name="itemdata" class="register">Register</button><br>
      </div>
      <br>
      <?php  
      $sql5 = "SELECT * FROM itemdata";
      $result2 = $conn->query($sql5);
          
      if ($result2->num_rows == 0) {
      } else {
      echo "<div class='wrap_link'><a style= 'color: #6ba3ff;' href='main.php'  class='link' >Back to main</a></div>";
      }
          
      ?>
    </div>  
  </form>
</body>
</html>