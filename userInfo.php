<?php
session_start();
?>

<?php 
	
	$authName = $_SESSION["authName"];
	include 'databaseconnection.php';

	$value = "";	

	if(isset($_GET["searchText"])){

		$value = $_GET["searchText"];

		$sqlresult = "SELECT * from userinfo where name LIKE '%".$value."%'";
		$result = mysqli_query($conn, $sqlresult);

	}else{
		$sqlresult = "SELECT * from userinfo";
		$result = mysqli_query($conn, $sqlresult);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>User Info</title>

	<link rel="stylesheet" type="text/css" href="userInfostyle.css">
	
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
			<li><a href="notificationPage.php">Notification</a></li>
			<li><a class="active" href="userInfo.php">User Info</a></li>
			<li><form action="<?php $_SERVER["PHP_SELF"]; ?>" method = "post">
		<input id="logout" type="submit" name="logout" value="Log Out">
	</form></li>
			<li><a href="aboutPageauth.php">About</a></li>
			</ul>
		</div>
	</div>

	<div class="topnav">
        <div class="search-container">

        	<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="get">
	            <input type="search" placeholder="Enter Teacher Initial..." name="searchText" id="search" onsearch="searchFuntion()" value="<?php echo $value?>">
	            <button type="submit"><i class="fa fa-search"></i></button>
            </form>
    	</div>
    </div>

	<div id="containerDiv">

		<h2 id="errorMsg" style="text-align: center; margin-left: auto; margin-right: auto; margin-top: 40px; display: none;">No User's Information Found</h2>

		<?php

		$rowCount = 0;
			$arrayofrows = array();

		if (mysqli_num_rows($result)>0) {

			while($row  = mysqli_fetch_array($result)){

				$arrayofrows[] = $row;

				echo '<div class="card_teacher">';

			echo '<div class="userInfo">
							<h2 id="initialTcr">'.$row["name"].'</h2>';

				echo '<div class="info">
				
									<span id="nameTcr">'.$row["stdId"].'</span>
								</div>';

				echo '<div class="info">
									<span id="designationTcr">Email: '.$row["email"].'</span>
								</div>';

				echo '<div class="info">
									<span id="departmentTcr">Contact: '.$row["phoneNumber"].'</span>
								</div>';

				echo '<div class="info">
									<span id="emailTcr">Address: '.$row["address"].'</span>
								</div>';

				echo '<div class="info">
				<span id="phoneTcr">Username: '.$row["userName"].'</span> </div>';

				echo '<div class="info">
				<span id="phoneTcr">Password: '.$row["password"].'</span> </div></div>';

    		echo '<form id="btnForm" method="post">';

				echo '<input type="submit" name="reject'.$rowCount.'" id="reject" value="Delete"></form>';

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

	<footer>
		<hr>
		<p>&copy; 2021 Team Anonymouns. All Rights Reserved</p>
	</footer>

	<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    	for ($i=0; $i <$rowCount ; $i++) { 

    		if (isset($_POST['reject'.$i])){

    			$id = $arrayofrows[$i][3];

				$delsql = "DELETE FROM userInfo WHERE stdId ='$id'";

				if (mysqli_query($conn, $delsql)){
					//deletedone
					echo "<script> window.alert('Delete Userinfo information'); </script>";
					echo "<script> window.location.assign('userInfo.php'); </script>";
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