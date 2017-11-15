<?php
	include '../process/db_login.php';
	session_start();

	if (ISSET($_POST['username'])) {
		$username = trim($_POST['username']);
		$password = md5(trim($_POST['password']));
		$departemen = trim($_POST['departemen']);

		$query = 'SELECT COUNT(*) AS total FROM pengguna WHERE LOWER(username)=LOWER("'.$username.'") AND id_departemen="'.$departemen.'"';
		if (mysqli_query($conn, $query)) {
			$query = mysqli_query($conn, $query);
			$data = mysqli_fetch_assoc($query);
			// Username telah terdaftar
			if ($data['total'] > 0) {
				header('Location: ../lite/tambah_pengguna.php?balasan=1');	
			} elseif ($data['total'] == 0) {
				// Belum terdaftar
				$query = "INSERT INTO pengguna (username, password, id_departemen, level) VALUES ('$username', '$password', '$departemen', 'm')";
				if (mysqli_query($conn, $query)) {
					header('Location: ../lite/lihat_pengguna.php?balasan=1');
				} else {
					header('Location: ../lite/lihat_pengguna.php?balasan=2');
				}				
			}
		} else {
			header('Location: ../lite/lihat_pengguna.php?balasan=2');
		}
	}
?>