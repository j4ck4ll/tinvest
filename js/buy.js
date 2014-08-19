function prepareEventHandlers() {
	document.getElementById("frmBuy").onsubmit = function() {
		//preverim, če so polja prazna
		if(document.getElementById("stock").value == "" || document.getElementById("shares").value == "") 
		{
			if(document.getElementById("stock").value == "")
			{
				//prikažem napake za prazna polja
				document.getElementById("errorMessageStock").innerHTML = "Prosimo, vnesite simbol.";
				if(document.getElementById("shares").value == "")
					document.getElementById("errorMessageShares").innerHTML = "Prosimo, vnesite število.";
				return false;
			}
		}
		else
		{
			//če ni napak
			document.getElementById("errorMessageStock").innerHTML = "";
			document.getElementById("errorMessageShares").innerHTML = "";
			return true;
		}
	};
}
//počakam, da se okno naloži, nato kličem funkcijo
window.onload = function() {
	prepareEventHandlers();
}