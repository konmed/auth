<?php
session_start();
include 'conn.php';
$login=$_POST['login'];
$pass=$_POST['pass'];
$auth=$_POST['auth'];
$close=$_POST['close'];


if ($auth) {
	$_SESSION['login']=$_POST['login'];
	$_SESSION['pass']=$_POST['pass'];
	$_SESSION['auth']=$_POST['auth'];
}

if ($close) {
	session_unset();
}

$query_str="SELECT * FROM users WHERE login='$_SESSION[login]' AND pass='$_SESSION[pass]'";
$query_run=mysqli_query($connect,$query_str);
$query_count=mysqli_num_rows($query_run);
$out=mysqli_fetch_array($query_run);
	
	$gender=$out['gender'];
	switch ($gender) 
	{
		case 'm':$gender="Уважаемый";$g="Мужской";
			
			break;
		case 'f':$gender="Уважаемая";$g="Женский";
			
			break;
	}

/*print_r($query_run);*/


if ($_SESSION['auth']) {
	if ($_SESSION['login'] and $_SESSION['pass']) {
		if ($query_count==1) {


			if ($out['role']=='admin') {
				include 'pages/admin.php';
				
			}
			elseif ($out['role']=='user') {
				include 'pages/user.php';
			}
			elseif ($out['role']=='moderator') {
				include 'pages/moderator.php';
			}
			



			// echo "Вы зашли";
			echo "<form  method=POST action=?logout=1  >
					<input class = 'btn_close' type=submit name=close value=Выйти>
				  </form>";
			





		}
		elseif($query_count==0)
		{


			include 'pages/form_reg.php';
			echo "Такого пользователя не существует";



		}
	}
	else
	{
		include 'pages/form_reg.php';
		echo "Заполните все поля";
	}
}
else
{
	include 'pages/form_reg.php';
	if ($_GET['logout']==1) {
		// echo "Вы вышли";
	}

}




?>