<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="registration_style.css">
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
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a class="active" href="registration.php">Registration</a></li>
			<li><a href="login.php">Log In</a></li>
			<li><a href="about.php">About</a></li>
		</ul>
	</div>

	<div class="info">
		<div class="page">
			<h2>Sign Up</h2>
			<h4>Welcome!! Register Now<h4>
				<br><br>

			<form action="<?php $_SERVER["PHP_SELF"]?>" onsubmit="return registrationValidation()" method="post">
				<label>Name <span style="color: red;">*</span></label><br>
				<input type="text" name="name" id="name" placeholder="Ex. Abul Kalam" value="<?php echo $_POST['name'] ?? ''; ?>">
				<p id="nameError"></p><br>

				<label>Username  <span style="color: red;">*</span></label><br>
				<input type="text" name="uid" id="userId" placeholder="Ex. abul420" value="<?php echo $_POST['uid'] ?? ''; ?>">
				<p id="userNameError"></p><br>

				<label>Password  <span style="color: red;">*</span></label><br>
				<input type="Password" name="password" id="userPassword" placeholder="Password">
				<p id="passwordError"></p><br>

				<label>Confirm Password  <span style="color: red;">*</span></label><br>
				<input type="Password" name="password" id="confirmPassword" placeholder="Enter Password Again">
				<p id="confirmpasswordError"></p><br>
				
				<label>Student ID  <span style="color: red;">*</span></label><br>
				<input type="text" name="studentid" id="studentId" placeholder="Ex. 181-15-1XXXXX" value="<?php echo $_POST['studentid'] ?? ''; ?>">
				<p id="stdIdError"></p><br>

				<label>Email  <span style="color: red;">*</span></label><br>
				<input type="email" name="email" id="studentEmail" placeholder="abul15-XXXX@diu.edu.bd" value="<?php echo $_POST['email'] ?? ''; ?>">
				<p id="emailError"></p><br>

				<label>Phone Number  <span style="color: red;">*</span></label><br>
				<input type="phone" name="phone" id="userPhone" placeholder="+88019XXXXXXXX" value="<?php echo $_POST['phone'] ?? ''; ?>">
				<p id="phoneNumberError"></p><br>

				<label>Address  <span style="color: red;">*</span></label><br>
				<input type="address" name="address" id="address" placeholder="Ex. Dhanmondi, Dhaka" value="<?php echo $_POST['address'] ?? ''; ?>">
				<p id="addressError"></p><br>

				<input type="submit" name="submit_form" value="Sign Up">

			</form>
		</div>
	</div>

	<footer>
		<hr>
		<p>&copy; 2021 Team Anonymouns. All Rights Reserved</p>
	</footer>

	<script type="text/javascript" src="registration_script.js"></script>

	<?php

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			include 'databaseconnection.php';

			$name = $_POST["name"];
			$userName = $_POST["uid"];
			$userPass = $_POST["password"];
			$stdId = $_POST["studentid"];
			$email = $_POST["email"];
			$phone = $_POST["phone"];
			$address = $_POST["address"];

			$sql = "INSERT INTO userinfo (name, userName, password, stdId, email, phoneNumber, address)
				VALUES ('$name', '$userName', '$userPass', '$stdId', '$email', '$phone', '$address');";

			if (mysqli_query($conn, $sql)) {
				echo "<script> window.alert('Registration Successful'); </script>";
				echo "<script> window.location.assign('login.php'); </script>";
			}
			else{
				$error = explode(" ",mysqli_error($conn));

				switch ($error[5]) {
					case "'userName'":
						echo "<script>
						var errorMsg = 'Username already taken'
						document.getElementById('userId').style.borderColor = 'red';

						document.getElementById('userNameError').innerHTML = errorMsg;		
						</script>";
						break;

					case "'stdId'":
						echo "<script>
						var errorMsg = 'Student ID already exists'
						document.getElementById('studentId').style.borderColor = 'red';

						document.getElementById('stdIdError').innerHTML = errorMsg;		
						</script>";
						break;

					case "'email'":
						echo "<script>
						var errorMsg = 'Email already exists'
						document.getElementById('studentEmail').style.borderColor = 'red';

						document.getElementById('emailError').innerHTML = errorMsg;		
						</script>";
						break;
					
					default:
						//no error
						break;
				}
			}
		}
	?>	


</body>
</html>