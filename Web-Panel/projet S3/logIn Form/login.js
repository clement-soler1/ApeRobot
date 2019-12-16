function switchInscri() {

	var liElement = document.getElementById("myLI");
	liElement.classList.add("hide");
 	var siElement = document.getElementById("mySI");
	siElement.classList.remove("hide");
}

function switchConnect() {

	var siElement = document.getElementById("mySI");
	siElement.classList.add("hide");
	var liElement = document.getElementById("myLI");
	liElement.classList.remove("hide");
}

var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Les mot de passe ne sont pas identiquent");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;