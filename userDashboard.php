<?php
session_start();
?>


<?php 

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
	<link rel="stylesheet" type="text/css" href="userDashStyle.css">
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
			<p id="hiText">Hi, Rozanee</p>	
		</div>

		<div class="navItem">
			<ul>
			<li><a class="active" href="userDashboard.php">Dashboard</a></li>
			<li><a href="userProfile.php">Profile</a></li>
			<li><a href="userContribution.php">Contribution</a></li>
			<li><form action="<?php $_SERVER["PHP_SELF"]; ?>" method = "post">
		<input id="logout" type="submit" name="logout" value="Log Out">
	</form></li>
			<li><a href="aboutPage.php">About</a></li>
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

		if (mysqli_num_rows($result)>0) {

			while($row  = mysqli_fetch_assoc($result)){

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

			echo '<div class="info"> <img class="icon" src="images/icon_phone.png" alt=""/><span id="phoneTcr">'.$row["phone"].'</span>';

    		echo '</div> </div> </div> </div>';

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
		$userName = $_SESSION["userName"];
		$name = $_SESSION["name"];		
		$studentId = $_SESSION["studentId"];
		$email = $_SESSION["email"];
		$phone = $_SESSION["phone"];
		$address = $_SESSION["address"];

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