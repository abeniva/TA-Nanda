<?php
	include '../process/db_login.php';
	$id = $_GET['id'];

	$query = 'DELETE FROM departemen WHERE id_departemen='.$id.'';
	if (mysqli_query($conn, $query)) {
		$query = 'DELETE FROM detail_dmu WHERE id_departemen='.$id.'';
		if (mysqli_query($conn, $query)) {
			$query = 'DELETE FROM pengguna WHERE id_departemen='.$id.'';
			if (mysqli_query($conn, $query)) {
				$query = 'DELETE FROM perhitungan_efisiensi WHERE id_departemen='.$id.'';
				if (mysqli_query($conn, $query)) {
					header('Location: ../lite/lihat_departemen.php?balasan=3');
				} else {
					header('Location: ../lite/lihat_departemen.php?balasan=4');
				}
			} else {
			    header('Location: ../lite/lihat_departemen.php?balasan=4');
			}
		} else {
		    header('Location: ../lite/lihat_departemen.php?balasan=4');
		}
	} else {
	    header('Location: ../lite/lihat_departemen.php?balasan=4');
	}
?>