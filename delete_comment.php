<?php 
	require_once("includes/common.php");

	$id = $_GET['id'];
	$sql_comment = "DELETE FROM comments WHERE id=$id";
	if(mysql_query($sql_comment))
	{
		redirect("comments.php");
	}
	else
	{
		apologize("Napaka.");
	}

 ?>