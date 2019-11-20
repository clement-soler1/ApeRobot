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