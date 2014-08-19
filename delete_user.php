<?php 
	require_once("includes/common.php");

	$id = $_GET['id'];
	$sql_user = "DELETE FROM users WHERE id=$id";
	if(mysql_query($sql_user))
	{
		$sql_stocks = "DELETE FROM stocks WHERE id=$id";
		if(mysql_query($sql_stocks))
		{
			$sql_history = "DELETE FROM history WHERE id=$id";
			redirect("admin_page.php");
		}
	}
	else
	{
		apologize("Napaka.");
	}

 ?>