<!DOCTYPE html>
<html>
<head>
	<title>Админпанель</title>
	<link rel="stylesheet" href="../admin.css">
</head>
<body>
	<?php
		echo "<img width=100px src=images/$out[avatar] alt = 'логотип'><br>";
		echo "Добро пожаловать<br>";
		echo "$gender $out[surname] $out[name] $out[fathername]!<br>";
		
	?>
	
	
<h3>Существующие товары:</h3>
	

	<?php
	include 'conn.php';
		$query_out_str = "SELECT * FROM goods";
		$query_out = mysqli_query($connect,$query_out_str);
		echo "<div class = 'goods'>";
		while ($out=mysqli_fetch_array($query_out)) 
		{
			echo "<div>
							<img src = images/tomato.png width = 25% alt = 'картинка товара' class = 'img_goods'></img>
							<div class='link_goods'>
								<div><b>$out[name_of_goods] </b></div> 
								<div><b>Артикул:$out[id]</b></div>
									
							</div>
							<p><b>Количество: </b>$out[qty_of_goods] шт.</p>
							<b>Описание:</b>
							<p class='description_of_goods' >$out[description_of_goods]</p>
							



						</div>";
							
			
		}
		
	?>
</body>	