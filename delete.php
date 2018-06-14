<?php
include 'connect.php';
       $itemID = $_GET["itemID"];
       $sql1 = "DELETE FROM itemadddata WHERE itemID=$itemID";
       if ($conn->query($sql1) === TRUE) {
        echo "";
       } else {
        echo "2 Error during updating record: " . $conn->error. "<br>";
        }
       $sql = "DELETE FROM itemdata WHERE itemID=$itemID";
       if ($conn->query($sql) === TRUE) {
       echo "";

       } else {
        echo "1 Error during updating record: " . $conn->error . "<br>";
        }
        header("Location:main.php");
       ?>