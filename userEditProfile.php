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
	$password = $_SESSION["password"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Info</title>
	<link rel="stylesheet" type="text/css" href="userEditProfilestyle.css">
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
			<h2>Edit Profile</h2>
			<h4>Edit Your Information<h4>
				<br><br>

			<form action="<?php $_SERVER["PHP_SELF"]?>"method="post">
				<label>Name <span style="color: red;">*</span></label><br>
				<input id="name" type="text" name="name" value="<?php echo $name?>">
				<p id="nameError"></p><br>

				<label>Student ID  <span style="color: red;">*</span></label><br>
				<input type="text" name="studentid" value="<?php echo $studentId?>" disabled><br><br>

				<label>Email  <span style="color: red;">*</span></label><br>
				<input type="email" name="email" value="<?php echo $email?>" disabled><br><br>

				<label>Phone Number  <span style="color: red;">*</span></label><br>
				<input id="phone" type="text" name="phone" value="<?php echo $phone?>">
				<p id="phoneError"></p><br>

				<label>Address  <span style="color: red;">*</span></label><br>
				<input id="address" type="text" name="address" value="<?php echo $address?>">
				<p id="addressError"></p><br>

				<input type="submit" name="submit" id="save" value="Save">
			</form>
		</div>
	</div>

	<footer>
		<hr>
		<p>&copy; 2021 Team Anonymouns. All Rights Reserved</p>
	</footer>

	<?php
	include 'databaseconnection.php';

	$getName = explode(" ", $name);

		echo "<script>
		document.getElementById('hiText').innerHTML = 'Hi,&nbsp;".$getName[0].
		"'</script>";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$editName = $_POST["name"];
		$editPhone = $_POST["phone"];
		$editAddress = $_POST["address"];

		if ($editName == '' || $editPhone == '' || $editAddress == '') {
			if ($editName == '') {
				echo "<script>
						var errorMsg = 'This filed required'
						document.getElementById('name').style.borderColor = 'red';

						document.getElementById('nameError').innerHTML = errorMsg;		
						</script>";
			}
			if ($editPhone == '') {
				echo "<script>
						var errorMsg = 'This filed required'
						document.getElementById('phone').style.borderColor = 'red';

						document.getElementById('phoneError').innerHTML = errorMsg;		
						</script>";
				
			}
			if ($editAddress == '') {
				echo "<script>
						var errorMsg = 'This filed required'
						document.getElementById('address').style.borderColor = 'red';

						document.getElementById('addressError').innerHTML = errorMsg;		
						</script>";
			}
			
		}
		else{
			$sql = "UPDATE userinfo SET name = '$editName', email = '$email', phoneNumber = '$editPhone', address = '$editAddress' WHERE stdId = '$studentId'";

			if(mysqli_query($conn, $sql)){

				$_SESSION["name"] = $editName;
				$_SESSION["phone"] = $editPhone;
				$_SESSION["address"] = $editAddress;

			 	echo "<script> window.alert('Profile Updated'); </script>";
				echo "<script> window.location.assign('userProfile.php'); </script>";
			 } else{
			 	echo "Error: ".mysqli_error($conn);
			 }

			 mysqli_close($conn);
		}
	}

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