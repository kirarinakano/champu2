<?php
include 'connect.php';
include 'header.php';

$userID = $_SESSION["userID"];
$itemID = $_SESSION["itemID"];
$dataID = $_SESSION["dataID"];

$errorMessage = "";
$errorMessages = "";

$sql = "SELECT * FROM itemdata WHERE userID='$userID'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $itemname = $row['Itemname'];
    $amount = $row['Amount'];

    $sql2 = "SELECT * FROM itemadddata WHERE Registerday = (SELECT MAX(Registerday) FRoM itemadddata WHERE itemID='$itemID')";
    $result1 = $conn->query($sql2);
      if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
          $startday = $row1['Startday'];
          $endday = $row1['Endday'];
        }
      }
  }
}

if (isset($_POST["update"])) {
  $Itemname = $_POST['itemname'];
  $Amount = $_POST['amount'];
  $Startday = $_POST['startday'];
  $Endday = $_POST['endday'];

  $today = date("Y/m/d");

   if (strtotime($Endday) < strtotime($Startday)) {
      $errorMessages = "Please select end day after start day you selected";
     } elseif (strtotime($today) < strtotime($Endday)) {
      $errorMessages = "Please select the date before the current date.";
     } elseif (strtotime($today) < strtotime($Startday)) {
      $errorMessage = "The start day should be before or today. Please reselect.";
     } elseif (strtotime($Startday) > strtotime($Endday)) {
      $errorMessage = "The startday should be before the endday. Please reselect";
     } else {
      $sql = "UPDATE itemdata SET Itemname='$Itemname',Amount='$Amount'";
      if ($conn->query($sql) === TRUE) {
       echo "";
      } else {
         echo "1 Error during updating record: " . $conn->error . "<br>";
        }

        $sql1 = "UPDATE itemadddata SET Startday='$Startday',Endday='$Endday' WHERE dataID='$dataID'";
        if ($conn->query($sql1) === TRUE) {
       header('Location: main.php');
      } else {
         echo "1 Error during updating record: " . $conn->error . "<br>";
        }
     }
}

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="editdata.css">
  <title>Edit Data</title>
</head>
<body>

  <div class="tittle">
    <p>Edit Data</p>
  </div>
  <form action="editdata.php" method="POST" >
    <div class="frame">
      <div class="subtittle">
         <p>Item Name</p>
         <p>Amout</p>
      </div>
      <div class="itemdata">
        <input type="text" class="itemname" name="itemname" value="<?php echo $itemname ?>" maxlength="20" minlength="1" required placeholder="1-20" autocomplete="off">
        <input type="number" class="amount" name="amount" value="<?php echo $amount ?>" min="1" required autocomplete="off">
        <span>ml</span>
      </div>
      <div class="subtittle">
        <p>Use Start Date</p>
      </div>
      <input type="date" value="<?php echo $startday ?>" name="startday" class="date" required>
          <?php 
          echo $errorMessage;
          ?>
      <div class="subtittle">
        <p>Use End Date</p>
      </div>
      <input type="date" value="<?php echo $endday ?>" name="endday" class="date" required>
          <?php 
          echo $errorMessages;
          ?>
      <div class="wrap_update">
        <button type="submit" name="update" class="update">Update</button><br>
      </div>
      <br>
      <div class="wrap_link">
      <a style= 'color: #6ba3ff;' href='main.php'  class='link' >Back to main</a></div>
    </div>
  </form>
</body>
</html>