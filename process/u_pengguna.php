<?php
	include '../process/db_login.php';	
	if ((ISSET($_GET['id'])) AND ($_POST['username'])) {
		$id = $_GET['id'];
		$username = trim($_POST['username']);
		$password = md5(trim($_POST['password']));
		// Mengecek data apakah telah terdaftar sebelumnya
		$query = 'SELECT COUNT(*) AS total FROM pengguna WHERE LOWER(username)=LOWER("'.$username.'")';
		if (mysqli_query($conn, $query)) {
			$query = mysqli_query($conn, $query);
			$data = mysqli_fetch_assoc($query);
			if ($data['total'] > 0) {
				// Pengguna langsung klik simpan
				$query1 = 'SELECT COUNT(*) AS total FROM pengguna WHERE LOWER(username)=LOWER("'.$username.'") AND id_pengguna="'.$id.'"';
				$query1 = mysqli_query($conn, $query1);
				$data1 = mysqli_fetch_assoc($query1);
				if ($data1['total'] > 0) {
					// Nama tetap variabel lain berubah
					$query2 = 'SELECT COUNT(*) AS total FROM pengguna WHERE LOWER(username)=LOWER("'.$username.'") AND id_pengguna="'.$id.'" AND password="'.$password.'"';
					$query2 = mysqli_query($conn, $query2);
					$data2 = mysqli_fetch_assoc($query2);
					if ($data2['total'] == 0) {
						$query3 = ' UPDATE pengguna SET username="'.$username.'", password="'.$password.'" WHERE id_pengguna="'.$id.'" ';
						if (mysqli_query($conn, $query3)) {
							header('Location: ../lite/lihat_pengguna.php?balasan=5');
						} else {
							header('Location: ../lite/lihat_pengguna.php?balasan=6');
						}
					} else {
						// Tidak ada perubahan
						header('Location: ../lite/lihat_pengguna.php');
					}
				} else {
					// Jika variabel a diubah menjadi variabel b, sedangkan variabel b sudah terdaftar
					header('Location: ../lite/ubah_pengguna.php?id='.$id.'&balasan=1');
				}
			} elseif ($data['total'] == 0) {
				// Belum terdaftar
				$query3 = ' UPDATE pengguna SET username="'.$username.'", password="'.$password.'" WHERE id_pengguna="'.$id.'" ';
				if (mysqli_query($conn, $query3)) {
					header('Location: ../lite/lihat_pengguna.php?balasan=5');
				} else {
					header('Location: ../lite/lihat_pengguna.php?balasan=6');
				}
			}
		} else {
			header('Location: ../lite/lihat_pengguna.php?balasan=6');
		}
	}
?>