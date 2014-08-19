function prepareEventHandlers() {
	document.getElementById("frmRegister").onsubmit = function() {
		//če je katerokoli polje prazno
		if(document.getElementById("username").value == "" || document.getElementById("email").value == ""
			|| document.getElementById("password").value == "" || document.getElementById("password2").value == "") 
		{
			//pregledam posamezna polja in prikažem napake
			if(document.getElementById("username").value == "")
			{
				document.getElementById("errorMessageUsername").innerHTML = "Prosim, vnesite uporabniško ime.";
				return false;
			}
			else if(document.getElementById("email").value == "")
			{
				document.getElementById("errorMessageEmail").innerHTML = "Prosim, vnesite veljaven e-mail.";
				return false;
			}
			else if(document.getElementById("password").value == "")
			{
				document.getElementById("errorMessagePassword").innerHTML = "Prosim, vnesite geslo.";
				return false;
			}
			else if(document.getElementById("password2").value == "")
			{
				document.getElementById("errorMessagePassword2").innerHTML = "Prosim, ponovite geslo.";
				return false;
			}
		}
		else
		{
			//če ni napak, jih ne prikažem
			document.getElementById("errorMessageUsername").innerHTML = "";
			document.getElementById("errorMessageEmail").innerHTML = "";
			document.getElementById("errorMessagePassword").innerHTML = "";
			document.getElementById("errorMessagePassword2").innerHTML = "";
			return true;
		}
	};
}
//počakam, da se okno naloži, nato kličem funkcijo
window.onload = function() {
	prepareEventHandlers();
}