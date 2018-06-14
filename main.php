<?php
session_start();
include 'connect.php';
$Emailaddress = $_SESSION["Emailaddress"];

$sql = "SELECT * FROM itemdata LEFT JOIN itemadddata ON itemdata.itemID = itemadddata.itemID";
$result = $conn->query($sql);

$errorMessage = "";
$answer = "";
$target_day = "";
//click done button after select endday
 if (isset($_POST['done'])) {
  $today = date("Y/m/d");
  $target_day= $_POST['endday'];
  $startday = $_POST['startday'];
  $itemID = $_POST["itemID"];
  

    if (strtotime($target_day) < strtotime($startday)) {
      $errorMessage = "*Please select end day after start day you selected";
    } elseif (strtotime($today) === strtotime($target_day)) {
        $sql = "UPDATE itemadddata SET Endday='$target_day' WHERE  itemID='$itemID'";
        if ($conn->query($sql) === TRUE) {
          header("Location:main.php");
        } else {
          echo "1 Error during updating record: " . $conn->error . "<br>";  
          }
    } elseif (strtotime($today) > strtotime($target_day)) {
      $sql = "UPDATE itemadddata SET Endday='$target_day' WHERE itemID='$itemID'";
      if ($conn->query($sql) === TRUE) {
        header("Location:main.php");
      } else {
        echo "1 Error during updating record: " . $conn->error . "<br>";
        } 
    } elseif (strtotime($today) < strtotime($target_day)) {
      $errorMessage = "*End day should be before or today. Please reselect.";
      } 
//calculater at bottom
} elseif (isset($_POST['calculate'])) {
  $number1 = $_POST['average'];
  $number2 = $_POST['tripday'];
  $answer = $number1 * $number2;
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
// delete item data
  ?>
  <html>
    <body>
      <script type="text/javascript">
        function ConfirmMsg() {
       var result = confirm('Are you sure to delete?');
       if(result) {
        console.log(result);
      //はいを選んだときの処理
        
      document.getElementById("myForm").submit();

      } else {
       //いいえを選んだときの処理
       console.log('error');
      }
    }

    </script>
 </body>
</httml>

<!DOCTYPE html>
 <html>
  <head>
    <title>main</title>
    <link rel="stylesheet" href="main.css">

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
    <a href="add.php"><button class="additem">Add New Item</button></a>

    <div class="table">
      <table class="scroll">
        <thead>
          <tr>
          <th>Item</th>
          <th>ml</th>
          <th>Start day</th>
          <th>End day</th>
          <th>Average</th>
          <th>Days left</th>
          <th></th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        <?php

        $sql = "SELECT userID FROM userinfo WHERE Emailaddress='$Emailaddress'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $user = $row["userID"];
            $userID = $user;
            $_SESSION["userID"] = $userID; 
           }}
        $sql1 = "SELECT * FROM itemdata WHERE userID='$userID'";
        $result2 = $conn->query($sql1);
        if ($result2->num_rows > 0) {
          while ($row = $result2->fetch_assoc()) {
            $itemID = $row["itemID"];
            $amount = $row["Amount"];
            $_SESSION["itemID"] = $itemID;
            echo "<tr>";
            echo "<td>". $row["Itemname"] ."</td>";
            echo "<td>" . $row["Amount"] . "ml</td>";
            //select only latest data
            $sql2 = "SELECT * FROM itemadddata WHERE Registerday = (SELECT MAX(Registerday) FRoM itemadddata WHERE itemID='$itemID')";
            $result1 = $conn->query($sql2);
            if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
              $dataid = $row1["dataID"];
              $_SESSION["dataID"] = $dataid;
              // var_dump($_SESSION["dataID"]);

              echo "<td>". $row1["Startday"] . "</td>";
              echo "<td>";
              if (isset($row1["Endday"])) {
                echo  $row1['Endday'];
                $enddays = $row1['Endday'];
                $_SESSION['Endday'] = $enddays;
              } else {
                echo "<form action='main.php' method='post'>";
                echo "<input type='date' value='' name='endday' required>";
                echo "<input type='hidden' name='startday' value='". $row1["Startday"] ."'>";
                echo "<input type='hidden' name='itemID' value='". $row1["itemID"] ."'>";
                echo "<input type='submit' name='done' value='Done' />";
                echo "</form>";
              };

              echo "</td>";
              echo "<td>";
              //count number of record
              $sql = "SELECT COUNT(*) FROM itemadddata WHERE itemID='$itemID'";
                $result = $conn->query($sql);
                $num2 = $result->fetch_assoc();
                
                $count = intval($num2['COUNT(*)']);

                //calculate average
              $Startday = $row1["Startday"];
              if ($row1["Endday"] != "") {
                $Endday = $row1["Endday"];
                $day1 = strtotime($Startday);
                $day2 = strtotime($Endday);
                $seconddiff = abs($day2 - $day1);

                $daydiff = $seconddiff / (60 * 60 * 24) + 1;
                // var_dump($daydiff);
                
                $average = $amount / $daydiff;

                $sql3 = "UPDATE itemadddata SET Average='$average' WHERE itemID='$itemID'";
                if ($conn->query($sql3) === TRUE) {
                echo "";
                } else {
                echo "1 Error during updating record: " . $conn->error . "<br>";
                  }

                  //calculate average sum
                $sql4 = "SELECT SUM(Average) FROM itemadddata WHERE itemID='$itemID'";
                $result1 = $conn->query($sql4);
            
                $num = $result1->fetch_assoc();
                $sum = intval($num['SUM(Average)']);

                
                $ave = $sum / $count;

                $sql = "UPDATE itemdata SET Average='$ave' WHERE itemID='$itemID'";
                if ($conn->query($sql) === TRUE) {
                echo "";
                } else {
                echo "1 Error during updating record: " . $conn->error . "<br>";
                  }

              } 
              if (isset($row["Average"])) {
              echo round($row["Average"], 2, PHP_ROUND_HALF_DOWN);
              echo "ml";
              }
              // $ave = "";
              echo "</td>";
              echo "<td>";
              
                //if user have more than two record, display days left.
                if ($count >= 2) {
                $useday = $amount / $row["Average"];
                $usedays = round($useday,0);
                $nextbuy = date("Y-m-d ",strtotime($Startday . "+$usedays days"));
                $now = date("Y-m-d");
                $today = strtotime($now);
                $buynext = strtotime($nextbuy);
                  if ($today >= $nextbuy) {
                  $different = abs($buynext - $today);
                  $daysleft = $different / (60 * 60 * 24);
                  $sql = "UPDATE itemdata SET Daysleft='$daysleft' WHERE itemID='$itemID'";
                    if ($conn->query($sql) === TRUE) {
                    echo "";
                    } else {
                    echo "1 Error during updating record: " . $conn->error . "<br>";
                    }
                  }
                }
                $Daysleft = $row["Daysleft"];
                // var_dump($Daysleft);
                if ($Daysleft >= 0){
                  echo $row["Daysleft"];
                } else {
                  echo "0";
                }
                if (isset($Daysleft)) {
                  echo "days";
                }
              echo "</td>";
              echo "<td>";
              echo "<div class='wrapbutton'>";
              echo "<a href='editdata.php'>";
              echo "<button class='edit'>Edit</button></a>";
              echo "<form id='myForm' action='delete.php' method='delete'>";
              echo "<input type='hidden' name='itemID' value='". $row["itemID"]  ."'>";
              echo "<input class='delete' type='button' value='delete' onclick='ConfirmMsg()'>";
              echo "</div>";
              echo "</form>";
              echo "</td>";
              echo "<td>";
              echo "<a href='update.php?itemID=" . $row['itemID'] . "'>";
              //display update button only when endday is set.
              if (isset($row1['Endday'])){
               echo "<button class='update'>Update</button></a>";
              }
              echo "</td>";
              echo "</tr>";
          }}}} else {
          echo "0 results";
        }
        ?>
        </tbody>
      </table>
    </div>
  <div class="error">
   <?php 
    echo $errorMessage;
   ?>
  </div>
   <div class="calculater">
       <form action='main.php' method='post'>
       <div class="subtittle">
         <p>Average</p>
         <p>Trip Day</p>
        </div>
        <div class="bottom">
          <div class="ave">
         <input class='average' type="number" name="average" min="1" value="<?= $_POST['average'] ?>">
         <span>ml</span>
      　<p>×</p>
        </div>
        <div class="trip">
      　 <input class='tripday' type="number" name="tripday" min="1" value="<?= $_POST['tripday'] ?>">
      　 <p>=</p>
   　　 　 <p>You need</p>
    　　　 <?php
         echo $answer;
         ?>
    　　  <p>ml</p> 
        <input class='calculate' type="submit" name="calculate" value="Calculate">
       </div>
      </div>
    </form>
   </div>
  </body>
</html>
