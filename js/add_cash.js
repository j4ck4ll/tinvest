function prepareEventHandlers() {
	document.getElementById("frm_cash").onsubmit = function() {
		//preverim, če so polja prazna
		if(document.getElementById("select_user").value == "" || document.getElementById("add_cash_amount").value == "") 
		{
			if(document.getElementById("add_cash_amount").value == "")
			{
				//prikažem napake
				document.getElementById("errorMessageCash").innerHTML = "Prosim, vnesite vsoto denarja.";
				if(document.getElementById("select_user").value == "")
					document.getElementById("errorMessageUser").innerHTML = "Prosim, izberite uporabnika.";
				return false;
			}
		}
		else
		{
			//če ni napak
			document.getElementById("errorMessageUser").innerHTML = "";
			document.getElementById("errorMessageCash").innerHTML = "";
			return true;
		}
	};
}
//počakam, da se okno naloži, nato kličem funkcijo
window.onload = function() {
	prepareEventHandlers();
}