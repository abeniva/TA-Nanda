<?php
	include '../process/db_login.php';
	$id = $_GET['id'];
	$query = 'DELETE FROM pengguna WHERE id_pengguna='.$id.'';
	if (mysqli_query($conn, $query)) {
		header('Location: ../lite/lihat_pengguna.php?balasan=3');
	} else {
		header('Location: ../lite/lihat_pengguna.php?balasan=4');
	}
?>