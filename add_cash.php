<?php 

	require_once("includes/common.php");
	//preverim, če je vse nastavljeno
	 if(isset($_POST['submit']))
	 {
	 	if(isset($_POST['select_user']))
	 	{	 		
	 		if(isset($_POST['add_cash_amount']))
	 		{
	 			//poskrbim, da ni škodljiva koda
	 			$username = mysql_real_escape_string($_POST['select_user']);
	 			$cash = mysql_real_escape_string($_POST['add_cash_amount']);
	 			//posodobim uporabnikov račun
	 			$sql = "UPDATE users SET cash = cash + $cash WHERE username = '$username'";
	 			
	 			if(mysql_query($sql))
	 			{
	 				//preusmerim
	 				header("Location: admin_page.php");
	 			}
	 			else
	 			{
	 				//drugače se opravičim
	 				apologize("Napaka : " . mysql_error());
	 			}	 			
	 		}
	 		else
	 			apologize("Niste vnesli vsote.");
	 	}
	 	else
	 		apologize("Niste izbrali uporabnika.");
	 }

 ?>