<?php require("includes/common.php") ?>

<?php include("top.php"); ?>
<div id="middle">
	<?php
		$id = $_SESSION['id'];
		$sql = "SELECT * FROM users WHERE id=$id";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$username = $row['username'];
		$cash = $row['cash'];
		$profile_pic = $row['pic_url'];		

	 ?>
<div id="profile">
	<p>Prikazujem profil: <b><?php echo $username; ?></b></p>
	<? dump($profile_pic);?>
		<img id="profile_pic" src="<?php 
			if(!empty($profile_pic))
			{
				echo $profile_pic;
			}
			else
			{
				echo "profile_pics/default.jpeg";
			}
		 ?>" />
		<br>
		<form enctype="multipart/form-data" action="upload_pic.php" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
		<input type="file" id="upload_pic_button" name="file" >
		<br>
		<input type="submit" id="upload_pic_submit" value="Naloži sliko" >


	</div>
	<div id="profile_info">
		<br><br><br>
			<p class="p_info">Uporabniško ime: 
			<?php echo $username; ?>
			</p>
			<br>
			<p class="p_info">Premoženje:  
			<?php echo "$" . number_format($cash, 2); ?>
			</p>
			<br>
			<p class="p_info">Delnice:
			<br> 
			<?php  
				$sql_stocks = "SELECT * FROM stocks WHERE id=$id";
				$result = mysql_query($sql_stocks);
				while($row_stocks = mysql_fetch_array($result))
				{
					echo $row_stocks['symbol'];
					echo "<br>";
				}

			?>			
			</p>
			<br>			
			<br>
			<br>
			<br>
			<p class="p_info">Geslo:
				<a href="change_pass.php">Spremeni geslo</a>
			</p>
		</div>
</div>
<?php 
	require_once("/includes/footer.php");
 ?>