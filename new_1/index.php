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
 <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
<h2>CHOSOSE FROM HERE!</h2>
<div class="dropdown">
  <button class="dropbtn">LIST</button>
  <div class="dropdown-content">
    <a href="hr.php">HR</a>
    <a href="manger.php">MANAGER</a>
    <a href="sales.php">SALES</a>
     <a href="full.php">ALL EMPLOYEES</a>
  </div>
</div>





		
</body>
</html>