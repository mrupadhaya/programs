<?php
$db=mysqli_connect("localhost","root", "","registration");
if(isset($_POST['register'])) {
	$username=$_POST['username'];
	$email=$_POST['email'];
	$passsword=$_POST['password'];

	$sql_u="SELECT * FROM user WHERE username='$useranme'";
	$sql_e="SELECT * FROM user WHERE email='$email'";
	$res_u=mysqli_master_query($db, $sql_u) or die(mysqli_error($db));
	$res_e=mysqli_master_query($db, $sql_e) or die(mysqli_error($db));

	if(mysqli_num_rows($res_u) > 0){
		$name_error="USERNAME ALREADY TAKEN";
	}
	elseif(mysqli_num_rows($res_e) > 0){
		$name_error="EMAIL ALREDAY TAKEN";
	}
	else{
		$query="INSERT INTO user (username, email, password) VALUES ('$username','$email','". md5($password) ."')";
		$result=mysqli_query($db,$query) or die(mysqli_error($db));
		echo "YOUR DETAILS ARE SAVED TO THE DATABSE PLEASE LOGIN";
		exit();
		}
	}
?>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
<!----	<link rel="stylesheet" type="text/css" href="style.css">---->
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>