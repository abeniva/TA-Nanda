<?php
	include '../process/db_login.php';
	if ((ISSET($_GET['id'])) AND ($_POST['nama_departemen'])) {
		$id = $_GET['id'];
		$nama_departemen = trim($_POST['nama_departemen']);
		//Mengecek data telah terdaftar atau belum
		$query = 'SELECT COUNT(nama_departemen) AS total FROM departemen WHERE LOWER(nama_departemen)=LOWER("'.$nama_departemen.'")';
		if (mysqli_query($conn, $query)) {
			$query = mysqli_query($conn, $query);
			$data = mysqli_fetch_assoc($query);
			//Jika > 0 maka telah terdaftar
			if ($data['total'] > 0) {
				// Pengguna klik simpan tp data tidak diubah
				$query1 = 'SELECT COUNT(*) AS total FROM departemen WHERE LOWER(nama_departemen)=LOWER("'.$nama_departemen.'") AND id_departemen="'.$id.'"';
				$query1 = mysqli_query($conn, $query1);
				$data1 = mysqli_fetch_assoc($query1);
				if ($data1['total'] > 0) {
					header('Location: ../lite/lihat_departemen.php');
				} else {
					$query2 = 'SELECT COUNT(*) AS total FROM departemen WHERE LOWER(nama_departemen)=LOWER("'.$nama_departemen.'") OR id_departemen="'.$id.'"';
					if (mysqli_query($conn, $query2)) {
						$query2 = mysqli_query($conn, $query2);
						$data2 = mysqli_fetch_assoc($query2);
						if ($data2['total'] > 0) {
							header('Location: ../lite/ubah_departemen.php?id='.$id.'&balasan=1');			
						}
					}
				}
			} elseif ($data['total'] == 0) {
				// Data belum terdaftar
				$query3 = ' UPDATE departemen SET nama_departemen="'.$nama_departemen.'" WHERE id_departemen="'.$id.'" ';
				if (mysqli_query($conn, $query3)) {
					header('Location: ../lite/lihat_departemen.php?balasan=5');
				} else {
					header('Location: ../lite/lihat_departemen.php?balasan=6');
				}
			}
		} else{
			header('Location: ../lite/lihat_departemen.php?balasan=6');
		}
	}
?>