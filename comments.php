<?php
	//zahtevam nekatere datoteke 
	require_once("includes/common.php");
	include("top.php");
	//shranim id in najdem uporabnika
	$id = $_SESSION['id'];
	$sql_user = "SELECT * FROM users WHERE id=$id";
	$result = mysql_query($sql_user);
	$row = mysql_fetch_array($result);
	//pogledam, če je administrator
	$is_admin = $row['is_admin'];
	//če je komentar oddan
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['ta_comment']))
		{
			$comment = htmlspecialchars(mysql_real_escape_string($_POST['ta_comment']));			
			//vstavim v bazo
			$sql = "INSERT INTO comments(id_user,comment) VALUES ($id, '$comment')";
			if(!mysql_query($sql))
			{
				//če je napaka, se opravičim
				apologize("Nisem mogel shraniti komentarja.");
			}
		}
		else 
		{
			apologize("Nisem mogel shraniti komentarja.");
		}	
	}
?>
	<div id="middle">
      <h2>KOMENTARJI |</h2>
      //obrazec
      <form action="insert_comments.php" id="frmComment" method="post">
	<textarea name="ta_comment" id="ta_comment" cols="60" rows="5"></textarea>
	<br>
	<input type="submit" name="submit" id="submit" value="Komentiraj">
	</form>
      <div id="comments_display">
      <?php 
      //prikaz komentarjev
      $sql = "SELECT * FROM comments ORDER BY datetime DESC";
      $result = mysql_query($sql);
      while($row = mysql_fetch_array($result))
      {
      	$id_user = $row['id_user'];
      	$sql_user = "SELECT * FROM users WHERE id = $id_user";
      	$result_user = mysql_query($sql_user);
      	$row_user = mysql_fetch_array($result_user);
      	echo "<br>";
      	echo "<div class=\"user_comment\" >";
      	echo "<div id=\"comment_username\">";
      	echo $row_user['username'];
      	echo "</div>";
      	echo "<div id=\"comment_datetime\">";
      	echo date('j F Y', strtotime($row['datetime']));
      	echo " ob ";
      	echo date('H:i', strtotime($row['datetime']));      	
      	echo "</div>";

      	//če je admin, lahko briše komentarje
      	if($is_admin == 1)
      	{
	      	echo "<div class=\"remove_comment\">";	      		      	
	      	$id_comment = $row['id'];
	      	echo "<a class=\"remove_comment_link\" href=\"delete_comment.php?id=$id_comment\">Izbriši</a>";	      		      	
	      	echo "</div>";
      	}

      	echo "<div id=\"comment\">";

		if(strlen($row['comment'])>60) 
		{ //dolge komentarje razdeli na stringe po 60 in razdeli v vrstice
			$comment_array=str_split($row['comment'], 60);
			$i=sizeof($comment_array);
			for($j=0 ;$j < $i ;$j++)
			{
				echo "<pre>";
				echo htmlspecialchars($comment_array[$j]);
				echo "</pre>";
				echo "<br/>";
			}

			}
			else 
			{
				echo $row['comment'];
			}
				echo "</div>";
		      	echo "</div>";
	}
       ?>	
	</div>
	</div>    
  </body>
</html>
