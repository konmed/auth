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
		echo "Вы вошли как модератор!<br>";
		
	?>
	
	<h3>Добавить товар:</h3>
	<form method="POST" >
		<input class="input" type="text" name="name_of_goods" placeholder="Введите наименование товара" required=""><br>
		<input class="input" type="text" name="price_of_goods" placeholder="Введите стоимость товара" required="">  <br>
		<input class="input" type="text" name="qty_of_goods" placeholder="Введите количество товара" required=""><br>
	Опишите товар:
	<br>
	<textarea rows="5" cols="35" name="description_of_goods"></textarea><br><br>
		<input type="submit" name="add_goods" value="Добавить товар">
	</form>
	<br>
	<?php
	include 'conn.php';
	$name_of_goods=$_POST['name_of_goods'];
	$price_of_goods=$_POST['price_of_goods'];
	$qty_of_goods=$_POST['qty_of_goods'];
	$description_of_goods=$_POST['description_of_goods'];
	$add_goods=$_POST['add_goods'];

	if ($add_goods) 
	{
		$price_of_goods = $price_of_goods * $qty_of_goods;
		$query_add_str = "INSERT INTO goods (name_of_goods,price_of_goods,qty_of_goods,description_of_goods) VALUES ('$name_of_goods','$price_of_goods','$qty_of_goods','$description_of_goods');";
		$query_add = mysqli_query($connect,$query_add_str);
	}



	?>
<h3>Существующие товары:</h3>
	<!-- ------------------------------------------------------------------------------------------------------ -->

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
								<div>
									<div><a class = 'link_delete' href  = ?id=$out[id]> Удалить</a></div>
									<div><a class = 'link_edit' href = pages/edit_goods.php?id=$out[id]> Изменить</a></div>	
								</div>	
							</div>
							<p><b>Количество: </b>$out[qty_of_goods] шт.</p>
							<b>Описание:</b>
							<p class='description_of_goods' >$out[description_of_goods]</p>
							



						</div>";
							
			
		}
		echo "</div>";
		$id = $_GET['id'];
		$query_str_del = "DELETE  FROM goods WHERE id = '$id'";
		$query_run_del = mysqli_query($connect,$query_str_del);
	?>
</body>	