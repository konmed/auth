<meta charset="utf-8">

<?php

include '../conn.php';
$edit_name =$_POST['edit_name'];
$edit_pass = $_POST['edit_pass'];
$reg = $_POST['reg'];


$id = $_GET['id'];



	

	if ($edit_name && $edit_pass) 
	{
		$query_str_edit =" UPDATE `users` SET name = '$edit_name' , pass = '$edit_pass' WHERE id = '$id';";
		$query_run_edit = mysqli_query($connect,$query_str_edit);
	}

	$quary_str_out = "SELECT * FROM users WHERE id = '$id'";
	$quary_run_out = mysqli_query($connect,$quary_str_out);  

	$out=mysqli_fetch_array($quary_run_out);



?>

<form action = "edit.php?id=<?php echo $id;?> "  method="POST">
	<input type="text" name="edit_name" value = <?php echo $out['name']; ?>>
	<input type="text" name="edit_pass" value = <?php  echo $out['pass'];?>>
	<input type="submit" name="reg" value="изменить">
	

</form>



