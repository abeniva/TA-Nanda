<?php
	include '../process/db_login.php';
	
	if (ISSET($_GET['id'])) {
		$id = $_GET['id']; 
		$query = "SELECT * FROM variabel";
		if (mysqli_query($conn, $query)) {
			$query = mysqli_query($conn, $query);
		 	if (mysqli_num_rows($query) > 0) {
				while($var = mysqli_fetch_assoc($query)){
					$name = str_replace(' ','_',$var['nama_variabel']);
					$nilai_var = $_POST[$name];
					$query2 = mysqli_query($conn, 'UPDATE detail_dmu SET nilai_variabel="'.$nilai_var.'" WHERE id_departemen="'.$id.'" AND id_variabel="'.$var['id_variabel'].'"');
				}
			}
			header('Location: ../lite/lihat_dmu.php?balasan=5');
		} else {
			header('Location: ../lite/lihat_dmu.php?balasan=6');
		}
	} else {
		header('Location: ../lite/lihat_dmu.php?balasan=6');
	}
?>