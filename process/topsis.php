<?php
	include '../process/db_login.php';

	// Mendapatkan semua variabel dan bobot
	$query = mysqli_query($conn, "SELECT * FROM variabel ORDER BY jenis_variabel ASC, id_variabel ASC");
	if (mysqli_num_rows($query)>0) {
		$index = 0;
		while ($data = mysqli_fetch_assoc($query)) {
			$variabel[$index]['id_variabel'] = $data['id_variabel'];
			$variabel[$index]['jenis'] = $data['jenis_variabel'];
			$variabel[$index]['bobot'] = $data['bobot'];
			$index++;
		}
	}

	// Var Input
	$query = mysqli_query($conn, 'SELECT id_variabel FROM variabel WHERE jenis_variabel="Input" ORDER BY id_variabel');

	// Var Output
	$query = mysqli_query($conn, 'SELECT id_variabel FROM variabel WHERE jenis_variabel="Output" ORDER BY id_variabel');

	// Jumlah variabel input
	$n_var_input = 0;
	$q=mysqli_query($conn, 'SELECT COUNT(*) AS total FROM variabel WHERE jenis_variabel="Input"');
	$d=mysqli_fetch_array($q);
	$n_var_input=$d['total'];

	// Jumlah variabel output
	$n_var_output = 0;
	$q=mysqli_query($conn, 'SELECT COUNT(*) AS total FROM variabel WHERE jenis_variabel="Output"');
	$d=mysqli_fetch_array($q);
	$n_var_output=$d['total'];

	// Mendapatkan id departemen yang efisien
	$query = mysqli_query($conn, "SELECT id_departemen FROM perhitungan_efisiensi WHERE nilai_efisiensi='1' GROUP BY id_departemen ORDER BY id_departemen ASC");
	if (mysqli_num_rows($query)>0) {
		$index = 0;		
		while ($data = mysqli_fetch_assoc($query)) {
			$id_dep[$index] = $data['id_departemen'];
			$index++;
		}
	}

	// Mendapatkan jumlah dmu efisien
	$n_dmu_efisien = sizeof($id_dep);

	// Mendapatkan data tabel
	if ($n_dmu_efisien > 1) {
		$j=0;
		for ($i=0; $i < $n_dmu_efisien; $i++) { 
			$id = $id_dep[$i];
			$query = mysqli_query($conn, "SELECT d.nilai_variabel, v.jenis_variabel, d.id_departemen FROM detail_dmu AS d, variabel as v WHERE d.id_variabel = v.id_variabel AND d.id_departemen='".$id."' ORDER BY v.jenis_variabel ASC, d.id_variabel ASC");		
			if (mysqli_num_rows($query)>0) {
				$jj=1;
				$kk=1;
				while ($data = mysqli_fetch_assoc($query)) {
					if ($data['jenis_variabel'] == 'Input') {
						$tabel[$j]['id_dep'] = $data['id_departemen'];
						$tabel[$j]['input'.$jj] = $data['nilai_variabel'];
						$j++; $jj++;
					} else {
						$tabel[$j]['id_dep'] = $data['id_departemen'];
						$tabel[$j]['output'.$kk] = $data['nilai_variabel'];
						$j++; $kk++;
					}
					
				}
			}
		}
	} else {
		// Urutkan manual tergantung efisiensi
	} 

	// Matriks Ternormalisasi
	$total_var = $n_var_output + $n_var_input;
	for ($i=0; $i < $total_var ; $i++) { 
		$nilai = $tabel[$i]*2;
		
	}
	

	print_r($nilai);
	// for ($i=0; $i < $n_dmu_efisien; $i++) { 
		
	// }
	


	// function topsis(){

	// }
?>