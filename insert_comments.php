<?php 
	require_once("includes/common.php");
	$id = $_SESSION['id'];
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['ta_comment']))
		{
			$comment = mysql_real_escape_string($_POST['ta_comment']);
			$sql = "INSERT INTO comments(id_user,comment) VALUES ($id, '$comment')";
			if(!mysql_query($sql))
			{
				apologize("Nisem mogel shraniti komentarja: " . mysql_error());
			}
		}
		else 
		{
			apologize("Nisem mogel shraniti komentarja:" . mysql_error());
		}	
	}

	redirect("comments.php");

 ?>