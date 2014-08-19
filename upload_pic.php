<?php 
	require("includes/common.php");

	$id = $_SESSION['id'];

	$target_path = "profile_pics/";
	$allowedExts = array("jpg", "jpeg", "png", "gif");
	$tmp = explode(".", $_FILES["file"]["name"]);
	$extension = end($tmp);

	if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/png")) && ($_FILES["file"]["size"] < 10000000) && in_array($extension, $allowedExts))
	{
		$filename = $_FILES["file"]["name"];

		if ($_FILES["file"]["error"] > 0)
	    {
	    	echo "Error: " . $_FILES["file"]["error"] . "<br>";
	    }
		else
		{
			if (file_exists("profile_pics/" . $_FILES["file"]["name"]))
		    {
		    	apologize("{$filename} že obstaja");
		    }
		    else
		    {
		        move_uploaded_file($_FILES["file"]["tmp_name"],
		        "profile_pics/" . $_FILES["file"]["name"]);
		        

		        $sql = "UPDATE users SET pic_url = '$target_path$filename' WHERE id=$id";
		        mysql_query($sql);
		        if(!mysql_query($sql))
		        {
		        	echo mysql_error();
		        }
		        //dump($sql);
		    }
	    }
	}
	else
    {
    	apologize("Neveljavna datoteka. Lahko, da ste izbrali napačen format ali preveliko sliko.");
    }


 ?>