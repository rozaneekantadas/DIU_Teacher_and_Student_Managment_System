<?php
session_start();
?>

<?php 
	
	$authName = $_SESSION["authName"];

	include 'databaseconnection.php';

	$sqlresult = "SELECT * from contribution";
	$result = mysqli_query($conn, $sqlresult);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Notification</title>
	<link rel="stylesheet" type="text/css" href="notificationStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
			<li><a href="authorityDashboard.php">Dashboard</a></li>
			<li><a href="addTeacherInfo.php">Add Info</a></li>
			<li><a class="active" href="notificationPage.php">Notification</a></li>
			<li><a href="userInfo.php">User Info</a></li>
			<li><form action="<?php $_SERVER["PHP_SELF"]; ?>" method = "post">
		<input id="logout" type="submit" name="logout" value="Log Out">
	</form></li>
			<li><a href="aboutPageauth.php">About</a></li>
			</ul>
		</div>
	</div>

	<div id="containerDiv">
		<h2 id="errorMsg" style="text-align: center; margin-left: auto; margin-right: auto; margin-top: 40px; display: none;">No Notification </h2>

		<?php

		if (mysqli_num_rows($result)>0) {

			$rowCount = 0;
			$arrayofrows = array();

			while($row  = mysqli_fetch_array($result)){

				$arrayofrows[] = $row;

				echo '<div class="card_teacher">';
				echo '<div class="imgDiv">';
	echo '<img class="imageTcr" src="data:image;base64,'.$row["image"].' "> </div>';

			echo '<div class="userInfo">
							<h2 id="initialTcr">'.$row["initial"].'</h2>';

				echo '<div class="info">
									<img class="icon" src="images/icon_person.png" alt=""/>
				
									<span id="nameTcr">'.$row["name"].'</span>
								</div>';

				echo '<div class="info">
									<img class="icon" src="images/icon_des.png" alt=""/><span id="designationTcr">'.$row["designation"].'</span>
								</div>';

				echo '<div class="info">
									<img class="icon" src="images/icon_dept.png" alt=""/><span id="departmentTcr">'.$row["department"].'</span>
								</div>';

				echo '<div class="info">
									<img class="icon" src="images/icon_email.png" alt=""/><span id="emailTcr">'.$row["email"].'</span>
								</div>';

				echo '<div class="info"> <img class="icon" src="images/icon_phone.png" alt=""/><span id="phoneTcr">'.$row["phone"].'</span> </div> </div>';

				echo '<form id="btnForm" method="post">';

				echo '<input type="submit" name="reject'.$rowCount.'" id="reject" value="Reject">';

				echo '<input type="submit" name="accept'.$rowCount.'" id="accept" value="Accept">
			</form>';

    		echo '</div> </div>';

    		$rowCount++;

    			}
			}
			else{
				echo "<script>
						document.getElementById('errorMsg').style.display = 'block';

						</script>";
			}
		?>
		</div>
    </div>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    	for ($i=0; $i <$rowCount ; $i++) { 
    		if (isset($_POST['accept'.$i])) {
    			$initial = $arrayofrows[$i][0];
				$tcrName = $arrayofrows[$i][1];
				$tcrdes = $arrayofrows[$i][2];
				$tcrdept = $arrayofrows[$i][3];
				$tcremail = $arrayofrows[$i][4];
				$tcrphone = $arrayofrows[$i][5];
				$image = $arrayofrows[$i][6];

    			$sql = "INSERT INTO teacherinfo (initial, name, designation, department, email, phone, image)
				VALUES ('$initial', '$tcrName', '$tcrdes', '$tcrdept', '$tcremail', '$tcrphone', '$image');";
				if (mysqli_query($conn, $sql)) {

				$delsql = "DELETE FROM contribution WHERE initial='$initial'";

				if (mysqli_query($conn, $delsql)){
					//deletedone
					echo "<script> window.alert('You Accept Teacher information'); </script>";
					echo "<script> window.location.assign('notificationPage.php'); </script>";
					}

				}
    		}
    		if (isset($_POST['reject'.$i])){

    			$initial = $arrayofrows[$i][0];

				$delsql = "DELETE FROM contribution WHERE initial='$initial'";

				if (mysqli_query($conn, $delsql)){
					//deletedone
					echo "<script> window.alert('You Reject Teacher information'); </script>";
					echo "<script> window.location.assign('notificationPage.php'); </script>";
				}
    		}	
    	}
    }
    ?>

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