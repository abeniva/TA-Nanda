<?php
	include '../process/db_login.php';
	session_start();

	if (ISSET($_POST['nama_departemen'])) {
		$nama_departemen = trim($_POST['nama_departemen']);
		//Mengecek data telah terdaftar atau belum
		$query = 'SELECT COUNT(*) AS total FROM departemen WHERE LOWER(nama_departemen)=LOWER("'.$nama_departemen.'")';
		if (mysqli_query($conn, $query)) {
			$query = mysqli_query($conn, $query);
			$data = mysqli_fetch_assoc($query);
			//Jika > 0 maka telah terdaftar
			if ($data['total'] > 0) {
				header('Location: ../lite/tambah_departemen.php?balasan=1');
			} elseif ($data['total'] == 0) {
				$query = "INSERT INTO departemen (nama_departemen) VALUES ('$nama_departemen')";
				if (mysqli_query($conn, $query)) {
					header('Location: ../lite/lihat_departemen.php?balasan=1');
				} else {
					header('Location: ../lite/lihat_departemen.php?balasan=2');
				}		
			} 
 		} else {
 			header('Location: ../lite/lihat_departemen.php?balasan=2');
 		}
	}
?>