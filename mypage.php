<?php
session_start();

include 'connect.php';

$target_dir = "pics/";
$Emailaddress = $_SESSION["Emailaddress"];
$userID = $_SESSION["userID"];

if(!isset($_SESSION["Emailaddress"])){
	 header("Location: login.php");
}

$sql1 = "SELECT * FROM userinfo WHERE userID = $userID";
$result = $conn->query($sql1);

if ($result->num_rows > 0 ) {
  while ($row = $result->fetch_assoc()) {
    $Username = $row["Username"];
    $Picture = $row["Picture"];

  }
} else {
  echo "0 result";
}


if ($Picture == NULL) {
	$Picture = "unknow.png";
}
?>

<!DOCTYPE>
<html>
<head>
    
    <title>My page</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="mypage.css">

</head>
<body>
　　



    <div class="top">
    	<div class="middle">
    		<form action="logout.php" method="POST">
    		<input type="submit" value="Logout" name="logout" class="logout" >
    		</form>
    	</div>
    </div>  
      <p class="title"><strong>My page</strong></p><br>

<div class="prof">
<img src="pics/<?php echo $Picture; ?>" height="400px" width="400px" ><br>
</div>
<br>
  <h1 align="center" ><?php echo "$Username"; ?></h1>
<?php
  
?>


<div align="center" >
    <form action="mypage.php" method="post" enctype="multipart/form-data">
	    Change profile picture:
	    <input type="file" name="fileToUpload" id="fileToUpload"><br>

		<?php
		// Check if image file is a actual image or fake image
		if(isset($_POST["upload"])) {
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$filename = basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			if ($target_file == "pics/" || $target_file == "") {
				echo "";
			} else {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}

		    

		    // Check if file already exists
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}

			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 2000000) {
			    echo "The file size should be smaller than 2MB. Please reselect.";
			    $uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			    echo "✴︎Extention of the file is only JPG and PNG. Please reselect.";
			    $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

					 $sql = "UPDATE userinfo SET Picture = '$filename' WHERE userID = '$userID' ";

					 if ($conn->query($sql) === TRUE) {
					   echo "";
					   header("Location: mypage.php");
					 } else {
				       echo "Error: ". $sql . "<br>" . $conn->error;
				    }
				    

			    } else {
			        echo "";
			    }
			}
		}

		
		?>
        <br>
	    <input type="submit" value="Update" name="upload" class="upload"><br><br>

	    <input class="button" type="submit" formaction="changeemailaddress.php" value="Change email address" >&ensp;&ensp;&ensp;&emsp;&emsp;&emsp;&emsp;
	    <input class="button" type="submit" formaction="changepassword.php" value="Change password" >
	    <br><br><br>
	    <p class="text"><strong>Connect a Social Network</strong></p>

        <h5>Facebook Login</h5>
	    <a href="main.php">Back to main</a>
	</form>
</div>
</body>	