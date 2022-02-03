<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="login_style.css">
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
			<li><a href="registration.php">Registration</a></li>
			<li><a class="active" href="login.php">Log In</a></li>
			<li><a href="about.php">About</a></li>
		</ul>
	</div>

	<div class="div4">

		<div class="col1">
			<img src="images/techarlogo.png" alt="logo">
			
		</div>

		<div class="col2">

			<div class="page">
				<h2>Sign In</h2>
				<h4>Welcome back! Please signin to continue<h4>
					<br><br>

				<div id="containerStudent">

					<form action="<?php $_SERVER["PHP_SELF"]?>" onsubmit="return studentSignIn()" method="post">

						<label>Username</label><br>
						<input type="text" name="uid" id="stdId" placeholder="Enter your username"><br><br>

						<label>Password</label><br>
						<input type="Password" name="stdpassword" id="stdpassword" placeholder="Enter your password"><br><br>

						<div id="stdAlert">
							<img src="images/icon_error.png">
							<p id="alertText" style="color: #d32f2f; padding-left: 10px;">Please enter your user id and password</p>
						</div>

						<input type="submit" class="studentBtn" name="submit_student" value="Sign In as student">
						<br>
					</form>

					<hr class="divider">
						<p class="middleText">OR</p>
						<hr class="divider"><br><br>
					<button class="authorityBtnShift" onclick="showAuthortiy()">Sign In as authority</button>
				</div>

				<div id="containerAuthority">

				<form action="<?php $_SERVER["PHP_SELF"]?>" onsubmit="return authoritySignIn()" method="post">

					<label>Employee ID</label><br>
					<input type="number" name="employeeId" id="employeeId" placeholder="Enter your employee id"><br><br>

					<label>Password</label><br>
					<input type="Password" name="authpassword" id="authpassword" placeholder="Enter your password"><br><br>

					<div id="authAlert">
						<img src="images/icon_error.png">
						<p style="color: #d32f2f; padding-left: 10px;">Please enter your employee id and password</p>
					</div>

					<input type="submit" class="authorityBtn" name="submit_authority" value="Sign In as authority"><br>
				</form>

					<hr class="divider">
					<p class="middleText">OR</p>
					<hr class="divider"><br><br>
					<button class="studentBtnShift" onclick="showStudent()">Sign In as student</button>
				</div>
			</div>
		</div>
		
	</div>

	<footer>
		<hr>
		<p>&copy; 2021 Team Anonymouns. All Rights Reserved</p>
	</footer>

	<script type="text/javascript" src="loginPagescript.js"></script>

	<?php

		if (isset($_POST['submit_student'])) {
			include 'databaseconnection.php';

			$userName = $_POST["uid"];
			$userPass = $_POST["stdpassword"];

			$sql = "SELECT * FROM userinfo";

			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_assoc($result)){

					if($row["userName"] == $userName && $row["password"] == $userPass){

						$_SESSION["userName"] = $userName;

						$_SESSION["name"] = $row["name"];
						$_SESSION["studentId"] = $row["stdId"];
						$_SESSION["email"] = $row["email"];
						$_SESSION["phone"] = $row["phoneNumber"];
						$_SESSION["address"] = $row["address"];
						$_SESSION["password"] = $userPass;

						echo "<script> window.location.assign('userDashboard.php'); </script>";
						echo "<script>
						document.getElementById('stdAlert').style.display = 'none';
						</script>";
					}

				}
						echo "<script>
						document.getElementById('alertText').innerHTML = 'Wrong username and password'
						document.getElementById('stdAlert').style.display = 'flex';
						</script>";
			}

			mysqli_close($conn);
		}


		if (isset($_POST['submit_authority'])) {

			include 'databaseconnection.php';

			$userName = $_POST["employeeId"];
			$userPass = $_POST["authpassword"];

			$sql = "SELECT * FROM authorityinfo";

			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_assoc($result)){

					if($row["employeeId"] == $userName && $row["password"] == $userPass){

						$_SESSION["authName"] = $row["name"];

						echo "<script> window.location.assign('authorityDashboard.php'); </script>";
						echo "<script>
						document.getElementById('stdAlert').style.display = 'none';
						</script>";
					}

				}
						echo "<script>
						document.getElementById('alertText').innerHTML = 'Wrong empolyee id and password'
						document.getElementById('stdAlert').style.display = 'flex';
						</script>";
			}

			mysqli_close($conn);
		}
	?>

</body>
</html>