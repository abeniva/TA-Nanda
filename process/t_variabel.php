<?php
	include '../process/db_login.php';
	session_start();

	if (ISSET($_POST['nama_variabel'])) {
		$nama = trim($_POST['nama_variabel']);
		$jenis = trim($_POST['jenis_variabel']);
		$satuan = trim($_POST['satuan']);
		$bobot = trim($_POST['bobot']);

		// Mengecek apakah data sudah pernah terdaftar
		$query = 'SELECT COUNT(nama_variabel) AS total FROM variabel WHERE LOWER(nama_variabel)=LOWER("'.$nama.'")';
		if (mysqli_query($conn, $query)) {
			$query = mysqli_query($conn, $query);
			$data = mysqli_fetch_assoc($query);
			// Jika data > 0 artinya sudah terdaftar
			if ($data['total'] > 0) {
		    	header('Location: ../lite/tambah_variabel.php?balasan=1');
		} else {
			// Data belum terdaftar

			// Validasi jika menambah variabel baru
			// Jika terjadi penambahan variabel di mana dmu sudah pernah ditambahkan sebelum variabel baru ditambahkan
			// Maka dilakukan insert nilai variabel baru pada semua dmu yang ada dan detail dmu tidak null
			$query1 = "INSERT INTO variabel (nama_variabel, jenis_variabel, satuan, bobot) VALUES ('$nama', '$jenis', '$satuan', '$bobot')";
			if (mysqli_query($conn, $query1)) {
				// Membandingkan jumlah variabel agar sesuai antara tabel variabel dan tabel detail dmu

				// Menghitung jumlah variabel input dan output
				$query2 = mysqli_query($conn, 'SELECT * FROM variabel ORDER BY jenis_variabel ASC, id_variabel ASC');
				$input = 0;
				$output = 0;
				if (mysqli_num_rows($query2) > 0) {
					while($var = mysqli_fetch_assoc($query2)) {
						if ($var['jenis_variabel'] == 'Input') {
							$input++;
						} else {
							$output++;
						}
					}
					$total_var = $input + $output;
				}
				// Menghitung jumlah variabel pada tabel detail dmu
				$var_dmu = 0;
				$query3 = mysqli_query($conn, 'SELECT * FROM detail_dmu GROUP BY id_variabel ORDER BY id_variabel ASC');
				if (mysqli_num_rows($query3) > 0) {
					while ($var2 = mysqli_fetch_assoc($query3)) {
						$var_dmu++;	
					}
				}
				// Mengecek data telah masuk ke database atau belum
				$query4 = mysqli_query($conn, 'SELECT * FROM variabel WHERE nama_variabel="'.$nama.'" AND jenis_variabel="'.$jenis.'" AND satuan="'.$satuan.'" AND bobot="'.$bobot.'"');
				if ((mysqli_num_rows($query4) > 0) AND ($total_var != $var_dmu)) {
					$var4 = mysqli_fetch_assoc($query4);
					$id_var_baru = $var4['id_variabel'];
				
					// Menghitung ada tidaknya data pada tb detail dmu
					$query5 = mysqli_query($conn, 'SELECT * FROM detail_dmu GROUP BY id_departemen');
					if (mysqli_num_rows($query5) > 0) {
						while($var3 = mysqli_fetch_assoc($query5)) {
							$id_departemen = $var3['id_departemen'];
							// Insert value=1 pada id_var=$id_var_baru dan id_departemen=$id_departemen
							$query6 = "INSERT INTO detail_dmu (id_departemen, id_variabel, nilai_variabel) VALUES ('$id_departemen','$id_var_baru','1')";
							if (mysqli_query($conn, $query6)) {
								header('Location: ../lite/lihat_variabel.php?balasan=1');
							} else {
								header('Location: ../lite/lihat_variabel.php?balasan=2');
							}
						}
					}
				}
				header('Location: ../lite/lihat_variabel.php?balasan=1');
			} else {
				header('Location: ../lite/lihat_variabel.php?balasan=2');
			}
			// End Validation
		} 

		} else {
			header('Location: ../lite/lihat_variabel.php?balasan=2');
		}
	}
?>