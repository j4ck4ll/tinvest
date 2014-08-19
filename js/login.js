function prepareEventHandlers() {
	document.getElementById("frmLogin").onsubmit = function() {
		//če je katerokoli polje prazno
		if(document.getElementById("username").value == "" || document.getElementById("password").value == "") 
		{
			//če je prazno uporabniško ime
			if(document.getElementById("username").value == "")
			{
				document.getElementById("errorMessageUsername").innerHTML = "Prosimo, vnesite uporabniško ime.";
				return false;
			}
			//če je prazno geslo
			else if(document.getElementById("password").value == "")
			{
				document.getElementById("errorMessagePassword").innerHTML = "Prosimo, vnesite geslo.";
				return false;
			}
		}
		//drugač ne prikažem sporočil o napakah
		else
		{
			document.getElementById("errorMessageUsername").innerHTML = "";
			document.getElementById("errorMessagePassword").innerHTML = "";
			return true;
		}
	};
}
//počakam, da se okno naloži, nato kličem funkcijo
window.onload = function() {
	prepareEventHandlers();
}