<?php
	include '../process/db_login.php';
	session_start();
	if (ISSET($_POST['id_departemen'])) {
		$id_departemen = $_POST['id_departemen'];
		// Memastikan departemen terpilih belum terisi
		$query = mysqli_query($conn, 'SELECT * FROM detail_dmu WHERE id_departemen='.$id_departemen.'');
		if (mysqli_num_rows($query) > 0) {
			// Departemen telah terisi
			header('Location: ../lite/tambah_dmu.php?balasan=1');
		} else {
			$query1 = mysqli_query($conn, 'SELECT * FROM variabel');
			if (mysqli_num_rows($query1) > 0) {
				while ($var = mysqli_fetch_assoc($query1)) {
					$name = str_replace(' ','_',$var['nama_variabel']);
					$variabel = $_POST[$name];
					// Translate nama var -> id var
					$query2 = mysqli_query($conn, "SELECT * FROM variabel WHERE nama_variabel='".$var['nama_variabel']."'");
					if (mysqli_num_rows($query2) > 0) {
						while ($idvar = mysqli_fetch_assoc($query2)) {
							$id_variabel = $idvar['id_variabel'];
						}
					} else {
						header('Location: ../lite/lihat_dmu.php?balasan=2A');
					} 
					// Insert ke detail_dmu
					$query3 = mysqli_query($conn, "INSERT INTO detail_dmu (id_departemen, id_variabel, nilai_variabel) VALUES ('$id_departemen','$id_variabel','$variabel')");
				}				
			} else {
				header('Location: ../lite/lihat_dmu.php?balasan=2B');
			}
			// Berhasil
			header('Location: ../lite/lihat_dmu.php?balasan=1');
		}
	} else {
		header('Location: ../lite/lihat_dmu.php?balasan=2C&id='.$id_departemen.'');
	}
?>