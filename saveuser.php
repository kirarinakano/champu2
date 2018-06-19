<?php 

include 'connection.php';

// print_r($user);
if(isset($_SESSION['access_token'])) {

	$name = $user->name;
	$email = $user->email;
	$username = $user->screen_name;
	$userid = $user->id;
	$user_exist = "SELECT * FROM userinfo WHERE email = '$email'";

	if(($result_exist = mysqli_query($conn_db,$user_exist))) {

		$rowcount=mysqli_num_rows($result_exist);
		if(!$rowcount > 0) {
			$insert_user = "INSERT INTO userinfo(userID, Username, Emailaddress, password) VALUES($userid,'$username','$email','123456')";
				if(mysqli_query($conn_db,$insert_user)){
					
					$_SESSION['Emailaddress'] = $email;
					$_SESSION['userID'] = $userid;

					header("location: main.php");
				}

		} 
		
	}else{
		$_SESSION['Emailaddress'] = $email;
		$_SESSION['userID'] = $userid;
		header("location: main.php");
	} 

}
// $query = "INSERT INTO users(name, email) VALUES ('$name', '$email')";
// mysqli_query($conn,$query);

	

 ?>