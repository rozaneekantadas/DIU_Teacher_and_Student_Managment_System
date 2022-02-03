<?php
session_start();
?>

<?php
	$userName = $_SESSION["userName"];
	$name = $_SESSION["name"];		
	$studentId = $_SESSION["studentId"];
	$email = $_SESSION["email"];
	$phone = $_SESSION["phone"];
	$address = $_SESSION["address"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="userProfilestyle.css">
	<link rel="icon" href="images/diuIcon.png" type="image/gif" sizes="16x16">
</head>
<body>
	<div class="header">
		<div class="div1">
			<img src="images/diulogo.png" width="250" height="70">
		</div>
		<div class="div2">
			<img src="images/cselog.png" width="250" height="70">
		</div>
	</div>

	<div class="div3">
		<div class="proIcon">
			<img src="images/profileIcon.png" alt="propicicon">
			<p id="hiText"></p>	
		</div>

		<div class="navItem">
			<ul>
			<li><a href="userDashboard.php">Dashboard</a></li>
			<li><a class="active" href="userProfile.php">Profile</a></li>
			<li><a href="userContribution.php">Contribution</a></li>
			<li><form action="<?php $_SERVER["PHP_SELF"]; ?>" method = "post">
		<input id="logout" type="submit" name="logout" value="Log Out">
	</form></li>
			<li><a href="aboutPage.php">About</a></li>
			</ul>
		</div>
	</div>

    <div class="info">
		<div class="page">
			<div class="topHead">
				<h2>Profile</h2>
				<span><a href="userEditProfile.php"><img class="icon" src="images/editicon.png" alt=""/></a></span>
			</div>
			<h4>Your Information<h4>
				<br><br>
			<label>Name <span style="color: red;">*</span></label><br>
			<input type="text" name="name" value="<?php echo $name?>" disabled><br><br>

			<label>Username <span style="color: red;">*</span></label><br>
			<input type="text" name="uid" value="<?php echo $userName?>" disabled><br><br>

			<label>Student ID  <span style="color: red;">*</span></label><br>
			<input type="text" name="studentid" value="<?php echo $studentId?>" disabled><br><br>

			<label>Email  <span style="color: red;">*</span></label><br>
			<input type="email" name="email" value="<?php echo $email?>" disabled><br><br>

			<label>Phone Number  <span style="color: red;">*</span></label><br>
			<input type="text" name="phone" value="<?php echo $phone?>" disabled><br><br>

			<label>Address  <span style="color: red;">*</span></label><br>
			<input type="text" name="phone" value="<?php echo $address?>" disabled><br><br>
		</div>
	</div>

	<footer>
		<hr>
		<p>&copy; 2021 Team Anonymouns. All Rights Reserved</p>
	</footer>


	<?php
	$getName = explode(" ", $name);

		echo "<script>
		document.getElementById('hiText').innerHTML = 'Hi,&nbsp;".$getName[0].
		"'</script>";
	?>

	<?php

	if(isset($_POST["logout"])){
		session_unset();
		session_destroy();

		echo "<script> window.alert('Log Out'); </script>";
		echo "<script> window.location.assign('login.php'); </script>";
	}
	?>

</body>
</html>