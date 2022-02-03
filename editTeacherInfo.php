<?php
session_start();
?>

<?php 
	$authName = $_SESSION["authName"];
	$tcrinitial = $_SESSION["initial"];
	$tcrname = $_SESSION["tcrName"];
	$tcrdes = $_SESSION["tcrdes"];
	$tcrdept = $_SESSION["tcrdept"];
	$tcremail = $_SESSION["tcremail"];
	$tcrphone = $_SESSION["tcrphone"];
	$image = $_SESSION["image"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Info</title>
	<link href="editTeacherInfostyle.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
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
			<p>Hi,<?php echo "&nbsp;".$authName; ?></p>		
		</div>

		<div class="navItem">
			<ul>
			<li><a  class="active" href="authorityDashboard.php">Dashboard</a></li>
			<li><a href="addTeacherInfo.php">Add Info</a></li>
			<li><a href="notificationPage.php">Notification</a></li>
			<li><a href="userInfo.php">User Info</a></li>
			<li><form action="<?php $_SERVER["PHP_SELF"]; ?>" method = "post">
		<input id="logout" type="submit" name="logout" value="Log Out">
	</form></li>
			<li><a href="aboutPageauth.php">About</a></li>
			</ul>
		</div>
	</div>

    <div class="info">
		<div class="page">
			<h2>Edit Info.</h2>
			<h4>Edit Teacher's Information<h4>
				<br><br>
			<img class="imageTcr" src="<?php echo 'data:image;base64,'.$image?>" width="150" height="150"><br><br>

			<form method="post" enctype="multipart/form-data">
			<label for="file">Change Image<span style="color: red;">*</span></label><br>
			<input type="file" name="images" id="img">
			<p id="imageError"></p><br>

			<label>Initial <span style="color: red;">*</span></label><br>
			<input type="text" name="tcrInitial" id="tcrIntiial" placeholder="Ex. TSP" value="<?php echo $tcrinitial?>">
			<p id="initialError"></p><br>

			<label>Teacher Name  <span style="color: red;">*</span></label><br>
			<input type="text" name="tcrName" id="tcrName" placeholder="Ex. Tahmina Sultana Priya" value="<?php echo $tcrname ?>">
			<p id="nameError"></p><br>

			<label>Designation  <span style="color: red;">*</span></label><br>
			<input type="text" name="designation" id="designation" placeholder="Ex. Lecturer" value="<?php echo $tcrdes?>">
			<p id="desError"></p><br>

			<label>Department <span style="color: red;">*</span></label><br>
			<input type="text" name="department" id="department" placeholder="Ex. CSE" value="<?php echo $tcrdept?>">
			<p id="deptError"></p><br>

			<label>Email  <span style="color: red;">*</span></label><br>
			<input type="email" name="tcrEmail" id="tcrEmail" placeholder="Ex. tahmina.cse@diu.edu.bd" value="<?php echo $tcremail?>">
			<p id="emailError"></p><br>

			<label>Phone  <span style="color: red;">*</span></label><br>
			<input type="text" name="phone" id="phone" placeholder="Ex. 01679357283" value="<?php echo $tcrphone?>">
			<p id="phoneError"></p><br>

			<input type="submit" id="edit" name="submit" value="Edit">

		</form>
		</div>
	</div>

	<footer>
		<hr>
		<p>&copy; 2021 Team Anonymouns. All Rights Reserved</p>
	</footer>

	<?php

		include 'databaseconnection.php';

		if (isset($_POST['submit'])) {

			if (isset($_FILES['images']) && !empty($_FILES['images']['tmp_name'])) {

			if (getimagesize($_FILES['images']['tmp_name']) == FALSE) {
				echo "<script>
						var imageMsg = 'Please select a image';
						document.getElementById('img').style.borderColor = 'red';

						document.getElementById('imageError').innerHTML = imageMsg;		
				</script>";
			}
			else{
				$image = addslashes($_FILES['images']['tmp_name']);
				$name = addslashes($_FILES['images']['name']);
				$image = file_get_contents($image);
				$image = base64_encode($image);
				
				}	
			}


			$initial = $_POST['tcrInitial'];
			$tcrName = $_POST['tcrName'];
			$tcrdes = $_POST['designation'];
			$tcrdept = $_POST['department'];
			$tcremail = $_POST['tcrEmail'];
			$tcrphone = $_POST['phone'];

			if ($initial == '' || $tcrName == '' || $tcrdes == '' || $tcrdept == '' || $tcremail == '' || $tcrphone == '') {

				if ($initial == '') {
					echo "<script>
						var iniMsg = 'Please enter teacher inital';
						document.getElementById('tcrIntiial').style.borderColor = 'red';

						document.getElementById('initialError').innerHTML = iniMsg;		
				</script>";
					}

					if ($tcrName == '') {
						echo "<script>
						var nameMsg = 'Please enter teacher name';
						document.getElementById('tcrName').style.borderColor = 'red';

						document.getElementById('nameError').innerHTML = nameMsg;		
				</script>";
					}
					if ($tcrdes == '') {
						echo "<script>
						var desMsg = 'Please enter teacher designation';
						document.getElementById('designation').style.borderColor = 'red';

						document.getElementById('desError').innerHTML = desMsg;		
				</script>";
					}
					if ($tcrdept == '') {
						echo "<script>
						var deptMsg = 'Please enter teacher department';
						document.getElementById('department').style.borderColor = 'red';

						document.getElementById('deptError').innerHTML = deptMsg;		
				</script>";
					}
					if ($tcremail == '') {
						echo "<script>
						var emailMsg = 'Please enter teacher email';
						document.getElementById('tcrEmail').style.borderColor = 'red';

						document.getElementById('emailError').innerHTML = emailMsg;		
				</script>";
					}
					if ($tcrphone == '') {
						echo "<script>
						var phnMsg = 'Please enter teacher phone number';
						document.getElementById('phone').style.borderColor = 'red';

						document.getElementById('phoneError').innerHTML = phnMsg;		
				</script>";
					}					
				}
				else{
				   $sql = "UPDATE teacherinfo SET initial = '$initial', name = '$tcrName', designation = '$tcrdes', department = '$tcrdept', email = '$tcremail', phone = '$tcrphone', image = '$image' WHERE initial = '$tcrinitial'";

				if (mysqli_query($conn, $sql)) {
				echo "<script> window.alert('Teacher informaiton updated'); </script>";
				echo "<script> window.location.assign('authorityDashboard.php'); </script>";
					}
					else{
				$error = explode(" ",mysqli_error($conn));

				switch ($error[5]) {
					case "'initial'":
						echo "<script>
						var iniMsg = 'Teacher initial already exists';
						document.getElementById('tcrIntiial').style.borderColor = 'red';

						document.getElementById('initialError').innerHTML = iniMsg;		
				</script>";
						break;

					case "'email'":
						echo "<script>
						var emailMsg = 'Teacher email already exists';
						document.getElementById('tcrEmail').style.borderColor = 'red';

						document.getElementById('emailError').innerHTML = emailMsg;		
				</script>";
						break;
					
					default:
						//no error
						break;
					}
				}
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