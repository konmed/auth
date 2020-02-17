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
		echo "Вы вошли как администратор!<br>";
		
	?>
	
	<h3>Добавить пользователя:</h3>
	
	<div id="content">
		<form method="POST" enctype="multipart/form-data">
			<input  class="input" type="text" name="login" placeholder="логин" required=""><br>
			<input  class="input" type="password" name="pass" placeholder="пароль" required=""><br>
			<input  class="input" type="text" name="surname" placeholder="Фамилия" required=""><br>
			<input class="input"  type="text" name="name" placeholder="имя" required=""><br>
			<input  class="input" type="text" name="fathername" placeholder="Отчество" required=""><br>
			<input type="radio" name="gender" value="f" required="">ж<br>
			<input type="radio" name="gender" value="m" required="">м<br><br>
			<input  class="input" type="text" name="role" placeholder="роль" required=""><br>
			<input   type="file" name="image_file"><br>
			<input type="submit" name="reg_user" value="Добавить"><br>
		</form>
	</div>
<br>
<?php
//добавление нового пользователя в базу
include 'conn.php';
	$login = $_POST['login'];
	$pass = $_POST['pass'];
	$surname = $_POST['surname'];
	$name = $_POST['name'];
	$fathername = $_POST['fathername'];
	$gender = $_POST['gender'];

	$role = $_POST['role'];
	$reg_user = $_POST['reg_user'];

	


	
	if ($reg_user) 
	{
		
		 $login_new="user_".md5(md5($login));
		
		
		$name_file = $_FILES['image_file']['name'];
		$abs_path = "C:/OSPanel/domains/regwithfiles/users/$login_new/";
		$full_path = $abs_path.$name_file;
		if (!file_exists($full_path)) 
			{	if ($_FILES['image_file']['type']=='image/png' ||$_FILES['image_file']['type']=='image/jpeg') 
					{
						if ($_FILES['image_file']['size']<=6000000) 
						{
							$avatar = $_FILES['image_file']['name'];
							$q_add_str = "INSERT INTO users (login,pass,surname,name,fathername,gender,role,avatar) VALUES ('$login','$pass','$surname','$name','$fathername','$gender','$role','$avatar');";

							mkdir("C:/OSPanel/domains/regwithfiles/users/$login_new/");

							move_uploaded_file($_FILES['image_file']['tmp_name'], $full_path);
							mysqli_query($connect,$q_add_str);
							echo "Успешно загружен<br>";	
						}
						else
						{
							echo "файл не должен превышать 48Кб";
						}
						
					}
				else
					{
						echo "Файлы должны иметь тип jpg, jpeg, и png";	
					}	
				
				
			}
		else 
			{
                echo "такой файл есть";
			}
	}
	// echo $_FILES['image_file']['type'];
?>


<h3>Существующие пользователи:</h3>
<!-- --------------------------------------------------------------------------------- -->
 <?php
	// include 'conn.php';

//вывод позьзлвателей из базы

	$a = "SELECT * FROM users";
	$b = mysqli_query($connect,$a);

	
	echo"<div class = 'users'>";

	while ($out=mysqli_fetch_array($b)) 


			{
				

				if ($out['role']=='admin') 
				{
					$role="Администратор";
				}
				elseif ($out['role']=='moderator') {
					$role="Модератор";
				}
				if ($out['role']=='admin' || $out['role']=='moderator') 
				{

					$g=$out['gender'];
					switch ($g) 
						{
							case 'm':$g="Мужской";
								
								break;
							case 'f':$g="Женский";
								
								break;
						}
					
						echo "<div>
								<p>$out[login]</p>
								<p>$role</p>
								<div class = 'content'>
									<div><img width=80px src=images/$out[avatar] class='content_img' alt = 'логотип'></div>

									<div><b>Фамилия:</b>
										<p>$out[surname]</p>
										<b>Имя:</b>
										<p>$out[name]</p>
										<b>Отчество:</b>
										<p>$out[fathername]</p>
									</div>

								</div>
									<div class='gender'>
										<b>пол:</b>
										$g
									</div><br>

									<div class = 'link'>
									<a class= 'link_delete' href  = ?id=$out[id]> Удалить</a>
									<a class = 'link_edit' href = pages/edit_users.php?id=$out[id]> Изменить</a>
									</div>		
								</div>";
					 	
				}	 
			};

	echo"</div>";	
	$id = $_GET['id'];	
	$query_str_del = "DELETE  FROM users WHERE id = '$id'";
	$query_run_del = mysqli_query($connect,$query_str_del);
 ?>
 <!-- --------------------------------------------------------------------------------------------------------- -->
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