function registrationValidation(){

	var stdName = document.getElementById("name").value.trim();
	var userName = document.getElementById("userId").value.trim();
	var password = document.getElementById("userPassword").value.trim();
	var confirmPass = document.getElementById("confirmPassword").value.trim();
	var stdId = document.getElementById("studentId").value.trim();
	var email = document.getElementById("studentEmail").value.trim();
	var phoneNumber = document.getElementById("userPhone").value.trim();
	var address = document.getElementById("address").value.trim();
	var nameError = document.getElementById("nameError");
	var userNameError = document.getElementById("userNameError");
	var passwordError = document.getElementById("passwordError");
	var confirmPassError = document.getElementById("confirmpasswordError");
	var stdIdError = document.getElementById("stdIdError");
	var emailError = document.getElementById("emailError");
	var phoneNumberError = document.getElementById("phoneNumberError");
	var addressError = document.getElementById("addressError");
	var statusName = statususername = statuspassword = statuscofirmpass = statusid = statusemail = statusphone = statusaddress = "false";


	if (stdName == '' || userName == '' || password == '' || confirmPass == '' || stdId == '' || email == '' || phoneNumber == '' || address == ''){
		if (stdName == '') {
			var errorMsgName = "This field required";
			var statusName = "true";
		}
		else{
			errorMsgName = " ";
			statusName = "false";
		}

		if (userName == '') {
			var errorMsgusername = "This field required";
			var statususername = "true";
		}
		else{
			errorMsgusername = " ";
			statususername = "false";
		}

		if (password == '') {
			var errorMsgpassword = "This field required";
			var statuspassword = "true";
		}
		else{
			errorMsgpassword = " ";
			statuspassword = "false";
		}

		if (confirmPass == '') {
			var errorMsgconfirmpass = "This field required";
			var statuscofirmpass = "true";
		}
		else{
			if (matchPassword(password, confirmPass)) {
				errorMsgconfirmpass = " ";
				statuscofirmpass = "false";
			}
			else{
				errorMsgconfirmpass = "Password donot match";
				statuscofirmpass = "true";
			}
		}

		if (stdId == '') {
			var errorMsgid = "This field required";
			var statusid = "true";
		}
		else{
			if(studentIdValidate(stdId)){
				errorMsgid = " ";
				statusid = "false";
			}
			else{
				errorMsgid = "Invalid Student ID. DIU Student ID required"
				statusid = "true";
			}
		}

		if (email == '') {
			var errorMsgemail = "This field required";
			var statusemail = "true";
		}
		else{
			if(emailValidate(email)){
				errorMsgemail = " ";
				statusemail = "false";
			}
			else{
				errorMsgemail = "Invalid Email. DIU email required"
				statusemail = "true";
			}
		}

		if (phoneNumber == '') {
			var errorMsgphoneNumber = "This field required";
			var statusphone = "true";
		}
		else{
			errorMsgphoneNumber = " ";
			statusphone = "false";
		}

		if (address == '') {
			var errorMsgaddress = "This field required";
			var statusaddress = "true";
		}
		else{
			errorMsgaddress = " ";
			statusaddress = "false";
		}
	}
	else{
		if(emailValidate(email)){
			errorMsgemail = " ";
			statusemail = "false";
		}
		else{
			errorMsgemail = "Invalid Email. DIU email required"
			statusemail = "true";
		}

		if(studentIdValidate(stdId)){
			errorMsgid = " ";
			statusid = "false";
		}
		else{
			errorMsgid = "Invalid Student ID. DIU Student ID required"
			statusid = "true";
		}

		if (matchPassword(password, confirmPass)) {
			errorMsgconfirmpass = " ";
			statuscofirmpass = "false";
		}
		else{
			errorMsgconfirmpass = "Password did not match";
			statuscofirmpass = "true";
		}
		errorMsgName = " ";
		errorMsgusername = " ";
		errorMsgpassword = " ";
		errorMsgaddress = " ";
		errorMsgphoneNumber = " ";
	}

	if (statusName == "true") {
		document.getElementById("name").style.borderColor = "red";
		document.getElementById("nameError").innerHTML = errorMsgName;
	}
	else{
		document.getElementById("name").style.borderColor = "#8392a5";
		document.getElementById("nameError").innerHTML = errorMsgName;
	}

	if (statususername == "true") {
		document.getElementById("userId").style.borderColor = "red";
		document.getElementById("userNameError").innerHTML = errorMsgusername;
	}
	else{
		document.getElementById("userId").style.borderColor = "#8392a5";
		document.getElementById("userNameError").innerHTML = errorMsgusername;
	}

	if (statuspassword == "true") {
		document.getElementById("userPassword").style.borderColor = "red";
		document.getElementById("passwordError").innerHTML = errorMsgpassword;
	}
	else{
		document.getElementById("userPassword").style.borderColor = "#8392a5";
		document.getElementById("passwordError").innerHTML = errorMsgpassword;
	}

	if (statuscofirmpass == "true") {
		document.getElementById("confirmPassword").style.borderColor = "red";
		document.getElementById("confirmpasswordError").innerHTML = errorMsgconfirmpass;
	}
	else{
		document.getElementById("confirmPassword").style.borderColor = "#8392a5";
		document.getElementById("confirmpasswordError").innerHTML = errorMsgconfirmpass
	}

	if (statusid == "true") {
		document.getElementById("studentId").style.borderColor = "red";
		document.getElementById("stdIdError").innerHTML = errorMsgid;
	}
	else{
		document.getElementById("studentId").style.borderColor = "#8392a5";
		document.getElementById("stdIdError").innerHTML = errorMsgid;
	}

	if (statusemail == "true") {
		document.getElementById("studentEmail").style.borderColor = "red";
		document.getElementById("emailError").innerHTML = errorMsgemail;
	}
	else{
		document.getElementById("studentEmail").style.borderColor = "#8392a5";
		document.getElementById("emailError").innerHTML = errorMsgemail;
	}

	if (statusphone == "true") {
		document.getElementById("userPhone").style.borderColor = "red";
		document.getElementById("phoneNumberError").innerHTML = errorMsgphoneNumber;
	}
	else{
		document.getElementById("userPhone").style.borderColor = "#8392a5";
		document.getElementById("phoneNumberError").innerHTML = errorMsgphoneNumber;
	}

	if (statusaddress == "true") {
		document.getElementById("address").style.borderColor = "red";
		document.getElementById("addressError").innerHTML = errorMsgaddress;
	}
	else{
		document.getElementById("address").style.borderColor = "#8392a5";
		document.getElementById("addressError").innerHTML = errorMsgaddress;
	}

	if (statusName == "false" && statususername == "false" &&
		statuspassword == "false" && statuscofirmpass == "false" &&
		statusid == "false" && statusphone == "false" 
		&& statusemail == "false" && statusaddress == "false") {
		return true;
	}
	return false;
}

function emailValidate(input) {
    let regex = /^[a-z]+15-[0-9]+@diu\.edu\.bd$/i;
    return regex.test(input);
}

function studentIdValidate(input) {
    let regex = /[0-9]+-15-[0-9]+$/;
    return regex.test(input);
}

function matchPassword(str1, str2){
	return str1 == str2;
}