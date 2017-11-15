<?php
	include '../process/db_login.php';
	
	if ((ISSET($_GET['id'])) AND ($_POST['nama_variabel'])) {
		$id = $_GET['id'];
		$nama_variabel = trim($_POST['nama_variabel']);
		$jenis_variabel = trim($_POST['jenis_variabel']);
		$satuan = trim($_POST['satuan']);
		$bobot = trim($_POST['bobot']);
		// Mengecek data apakah telah terdaftar sebelumnya
		$query = 'SELECT COUNT(nama_variabel) AS total FROM variabel WHERE LOWER(nama_variabel)=LOWER("'.$nama_variabel.'")';
		if (mysqli_query($conn, $query)) {
			$query = mysqli_query($conn, $query);
			$data = mysqli_fetch_assoc($query);
			// Data telah terdaftar
			if ($data['total'] > 0) {
				// Pengguna klik simpan saat data tidak diubah
				$query1 = 'SELECT COUNT(*) AS total FROM variabel WHERE LOWER(nama_variabel)=LOWER("'.$nama_variabel.'") AND id_variabel="'.$id.'"';
				$query1 = mysqli_query($conn, $query1);
				$data1 = mysqli_fetch_assoc($query1);
				if ($data1['total'] > 0) {
					// Nama tidak berubah variabel lain berubah
					$query2 = 'SELECT COUNT(*) AS total FROM variabel WHERE LOWER(nama_variabel)=LOWER("'.$nama_variabel.'") AND id_variabel="'.$id.'" AND jenis_variabel="'.$jenis_variabel.'" AND satuan="'.$satuan.'" AND bobot="'.$bobot.'"';
					$query2 = mysqli_query($conn, $query2);
					$data2 = mysqli_fetch_assoc($query2);
					if ($data2['total'] == 0) {
						$query3 = ' UPDATE variabel SET nama_variabel="'.$nama_variabel.'", jenis_variabel="'.$jenis_variabel.'", satuan="'.$satuan.'", bobot="'.$bobot.'" WHERE id_variabel="'.$id.'" ';
						if (mysqli_query($conn, $query3)) {
							header('Location: ../lite/lihat_variabel.php?balasan=5');
						} else {
							header('Location: ../lite/lihat_variabel.php?balasan=6');
						}
					} else {
						// Tidak ada perubahan
						header('Location: ../lite/lihat_variabel.php');	
					}
				} else {
					// Jika variabel a diubah menjadi variabel b, sedangkan variabel b sudah terdaftar
					header('Location: ../lite/ubah_variabel.php?id='.$id.'&balasan=1');	
				}
			} elseif ($data['total'] == 0) {
				// Belum terdaftar
				$query3 = ' UPDATE variabel SET nama_variabel="'.$nama_variabel.'", jenis_variabel="'.$jenis_variabel.'", satuan="'.$satuan.'", bobot="'.$bobot.'" WHERE id_variabel="'.$id.'" ';
				if (mysqli_query($conn, $query3)) {
					header('Location: ../lite/lihat_variabel.php?balasan=5');
				} else {
					header('Location: ../lite/lihat_variabel.php?balasan=6');
				}
			}
		} else {
			header('Location: ../lite/lihat_variabel.php?balasan=6');
		}
	}
?>