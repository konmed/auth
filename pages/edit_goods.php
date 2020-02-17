<meta charset="utf-8">

<?php

	include '../conn.php';
	$edit_goods_name =$_POST['edit_goods_name'];

	$change_goods = $_POST['change_goods'];


	$id = $_GET['id'];



		

		if ($edit_goods_name) 
		{
			$query_str_edit =" UPDATE `goods` SET name_of_goods = '$edit_goods_name' WHERE id = '$id';";
			$query_run_edit = mysqli_query($connect,$query_str_edit);
		}

		$quary_str_out = "SELECT * FROM goods WHERE id = '$id'";
		$quary_run_out = mysqli_query($connect,$quary_str_out);  

		$out=mysqli_fetch_array($quary_run_out);



?>

<form action = "edit_goods.php?id=<?php echo $id;?> "  method="POST">
	<input type="text" name="edit_goods_name" value = <?php echo $out['name_of_goods']; ?>>
	
	<input type="submit" name="change_goods" value="изменить">
	

</form>



