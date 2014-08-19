//prikaže opozorila, če so polja prazna
function prepareEventHandlers() {
	document.getElementById("frmLogin").onsubmit = function() {
		if(document.getElementById("username").value == "") 
		{
			document.getElementById("errorMessageUsername").innerHTML = "Prosimo, vnesite uporabniško ime.";
			return false;
		}
		else
		{
			document.getElementById("errorMessageUsername").innerHTML = "";
			document.getElementById("errorMessagePassword").innerHTML = "";
			return true;
		}
	};
}

window.onload = function() {
	prepareEventHandlers();
}