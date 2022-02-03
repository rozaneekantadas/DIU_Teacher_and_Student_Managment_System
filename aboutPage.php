<!DOCTYPE html>
<html>
<head>
	<title>About</title>
	<link rel="stylesheet" type="text/css" href="aboutPagestyle.css">
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
			<li><a href="userDashboard.php">Dashboard</a></li>
			<li><a href="userProfile.php">Profile</a></li>
			<li><a href="userContribution.php">Contribution</a></li>
			<li><form action="<?php $_SERVER["PHP_SELF"]; ?>" method = "post">
		<input id="logout" type="submit" name="logout" value="Log Out">
	</form></li>
			<li><a class="active" href="aboutPage.php">About</a></li>
			</ul>
	</div>

	<div class="info">
		<div class="des">
			<h1>Supervisor</h1>
			<img src="images/tsp.jpg">
			<p>Tahmina Sultana Priya</p>
			<p>Lecturer</p>
			<p>Department of CSE</p>
			<p>Daffodil International University</p><br>
			<hr>

			<h2>Team Members</h2>
			<div id="team">

				<div id="mem1">
					<img src="images/supto.jpg">
					<p>Rozanee Kanta Das</p>
					<p>181-15-11126</p>
					<p>Department of CSE</p>
					<p>Daffodil International University</p>
				</div>

				<div id="mem2">
					<img src="images/jakir.jpeg">
					<p>Md. Jakir Hossain</p>
					<p>181-15-10871</p>
					<p>Department of CSE</p>
					<p>Daffodil International University</p>
				</div>

				<div id="mem3">
					<img src="images/sristy.png">
					<p>Arpita Mony Sristy</p>
					<p>181-15-11260</p>
					<p>Department of CSE</p>
					<p>Daffodil International University</p>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<hr>
		<p>&copy; 2021 Team Anonymouns. All Rights Reserved</p>
	</footer>

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