<?php
	include '../process/db_login.php';
	$id = $_GET['id'];
	$query = 'DELETE FROM detail_dmu WHERE id_departemen='.$id.'';
	if (mysqli_query($conn, $query)) {
		header('Location: ../lite/lihat_dmu.php?balasan=3');
	} else {
		header('Location: ../lite/lihat_dmu.php?balasan=4');
	}
?>