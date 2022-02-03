<?php
session_start();
?>

<?php 
	
	$authName = $_SESSION["authName"];
	include 'databaseconnection.php';

	$value = "";	

	if(isset($_GET["searchText"])){

		$value = $_GET["searchText"];

		$sqlresult = "SELECT * from teacherinfo where initial LIKE '%".$value."%'";
		$result = mysqli_query($conn, $sqlresult);

	}else{
		$sqlresult = "SELECT * from teacherinfo";
		$result = mysqli_query($conn, $sqlresult);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>

	<link rel="stylesheet" type="text/css" href="authDashStyle.css">
	
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
			<li><a class="active" href="authorityDashboard.php">Dashboard</a></li>
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

	<div class="topnav">
        <div class="search-container">

        	<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="get">
	            <input type="search" placeholder="Enter Teacher Initial..." name="searchText" id="search" onsearch="searchFuntion()" value="<?php echo $value?>">
	            <button type="submit"><i class="fa fa-search"></i></button>
            </form>
    	</div>
    </div>

	<div id="containerDiv">

		<h2 id="errorMsg" style="text-align: center; margin-left: auto; margin-right: auto; margin-top: 40px; display: none;">No Teacher's Information Found</h2>

		<?php

		$rowCount = 0;
			$arrayofrows = array();

		if (mysqli_num_rows($result)>0) {

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

				echo '<div class="info"> <img class="icon" src="images/icon_phone.png" alt=""/><span id="phoneTcr">'.$row["phone"].'</span> </div></div>';

    		echo '<form id="btnForm" method="post">';

				echo '<input type="submit" name="reject'.$rowCount.'" id="reject" value="Delete">';

				echo '<input type="submit" name="accept'.$rowCount.'" id="accept" value="Edit">
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

	<footer>
		<hr>
		<p>&copy; 2021 Team Anonymouns. All Rights Reserved</p>
	</footer>

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

				$_SESSION["initial"] = $initial;
				$_SESSION["tcrName"] = $tcrName;
				$_SESSION["tcrdes"] = $tcrdes;
				$_SESSION["tcrdept"] = $tcrdept;
				$_SESSION["tcremail"] = $tcremail;
				$_SESSION["tcrphone"] = $tcrphone;
				$_SESSION["image"] = $image;

				echo "<script> window.location.assign('editTeacherInfo.php'); </script>";

     		}

    		if (isset($_POST['reject'.$i])){

    			$initial = $arrayofrows[$i][0];

				$delsql = "DELETE FROM teacherinfo WHERE initial='$initial'";

				if (mysqli_query($conn, $delsql)){
					//deletedone
					echo "<script> window.alert('Delete Teacher information'); </script>";
					echo "<script> window.location.assign('authorityDashboard.php'); </script>";
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