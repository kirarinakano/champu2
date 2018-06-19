<?php include 'connection.php'; ?>
<?php if(!isset($_SESSION['access_token'])){
	header("location: index.php");
} ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p><?php echo $user->email; ?></p>
	<p><?php echo $user->name; ?></p>
	<p><?php echo $user->screen_name; ?></p>
	<?php 
		echo '<pre>';	print_r($user); echo '</pre>';
	 ?>
	<div><a href="logout.php">Logout</a></div>
</body>
</html>			