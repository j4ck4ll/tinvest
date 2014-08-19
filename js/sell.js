function prepareEventHandlers() {
	document.getElementById("frmSell").onsubmit = function() {
		//pogledam, če je polje izpolnjeno
		if(document.getElementById("numShares").value == "" || document.getElementById("numShares").value == "0") 
		{
			//prikažem napako
			document.getElementById("errorMessageNumShares").innerHTML = "Prosim, vnesite število delnic.";
			return false;			
		}
		else
		{
			//če ni napake
			document.getElementById("errorMessageNumShares").innerHTML = "";			
			return true;
		}
	};
}
//počakam, da se okno naloži, nato kličem funkcijo
window.onload = function() {
	prepareEventHandlers();
}