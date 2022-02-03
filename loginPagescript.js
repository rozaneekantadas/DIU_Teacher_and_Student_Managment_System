function showAuthortiy(){
	document.getElementById("stdAlert").style.display = "none";
	document.getElementById("containerStudent").style.display = "none";
	document.getElementById("containerAuthority").style.display = "inline";;
}

function showStudent(){
	document.getElementById("authAlert").style.display = "none";
	document.getElementById("containerStudent").style.display = "inline";
	document.getElementById("containerAuthority").style.display = "none";
}

function studentSignIn(){

	var uidText = document.getElementById("stdId").value;
	var stdPassText = document.getElementById("stdpassword").value;

	if (uidText == '' || stdPassText == '') {
		document.getElementById("stdAlert").style.display = "flex";
		return false;
	}
	else{
		document.getElementById("stdAlert").style.display = "none";
		return true;
	}
}

function authoritySignIn(){

	var employeeText = document.getElementById("employeeId").value;
	var authPassText = document.getElementById("authpassword").value;

	if (employeeText == '' || authPassText == '') {
		document.getElementById("authAlert").style.display = "flex";
		return false;
	}
	else{
		document.getElementById("authAlert").style.display = "none";
		return true;
	}
}