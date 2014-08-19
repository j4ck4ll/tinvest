function prepareEventHandlers() {
	document.getElementById("frmChangePass").onsubmit = function() {
		//če je katero polje prazno, prikažem napake
		if(document.getElementById("pass").value == "" || document.getElementById("pass2").value == ""
			|| document.getElementById("pass3").value == "") 
		{
			document.getElementById("errorMessageChangePass").innerHTML = "Izpolnite vsa polja.";
			document.getElementById("errorMessageChangePass2").innerHTML = "Izpolnite vsa polja.";
			document.getElementById("errorMessageChangePass3").innerHTML = "Izpolnite vsa polja.";
			
			if(document.getElementById("pass2").value != document.getElementById("pass3").value)
			{
				//če se gesli ne ujemata, prikažem napake
				document.getElementById("errorMessageChangePass2").innerHTML = "Gesli se ne ujemata.";
				document.getElementById("errorMessageChangePass3").innerHTML = "Gesli se ne ujemata.";
				return false;
			}
		}
		else
		{
			//če ni napak
			document.getElementById("errorMessageChangePass").innerHTML = "";
			document.getElementById("errorMessageChangePass2").innerHTML = "";
			document.getElementById("errorMessageChangePass3").innerHTML = "";
			return true;
		}
	};
}
//počakam, da se okno naloži, nato kličem funkcijo
window.onload = function() {
	prepareEventHandlers();
}