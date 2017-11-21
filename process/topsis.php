<?php
	include '../process/db_login.php';

	// Mengosongkan data
	$hapus = mysqli_query($conn, 'DELETE FROM perangkingan');

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

	// Jumlah variabel total
	$total_var = $n_var_input + $n_var_output;

	// Mendapatkan semua variabel dan bobot
	$query = mysqli_query($conn, "SELECT jenis_variabel, bobot FROM variabel ORDER BY jenis_variabel ASC, id_variabel ASC");
	if (mysqli_num_rows($query)>0) {
		$index = 0;
		$jj=1;
		$kk=1;
		while ($data = mysqli_fetch_assoc($query)) {	
			if ($data['jenis_variabel'] == 'Input') {
				$variabel[$index]['input'.$jj] = $data['bobot'];
				$jj++;
			} else {
				if ($data['jenis_variabel'] == 'Output') {
					$variabel[$index]['output'.$kk] = $data['bobot'];
					$kk++;
				}
			}
		}
	}
	// print_r($variabel);

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
						$tabel[$id]['input'.$jj] = $data['nilai_variabel'];
						$j++; $jj++;
					} else {
						$tabel[$id]['output'.$kk] = $data['nilai_variabel'];
						$j++; $kk++;
					}
					
				}
			}
		}
	} 

	// Nilai pembagi R bagian Input
	$sigma = $r = array();
	for ($i=1; $i <= $n_var_input ; $i++) { 
		$sigma['input'.$i] = 0;
		for ($j=0; $j < $n_dmu_efisien ; $j++) {
			$id = $id_dep[$j]; 
			$sigma['input'.$i] += pow($tabel[$id]['input'.$i],2);
		}
		$r['input'.$i]=sqrt($sigma['input'.$i]);
	}

	// Nilai pembagi R bagian output
	for ($i=1; $i <= $n_var_output ; $i++) { 
		$sigma['output'.$i] = 0;
		for ($j=0; $j < $n_dmu_efisien ; $j++) {
			$id = $id_dep[$j]; 
			$sigma['output'.$i] += pow($tabel[$id]['output'.$i],2);
		}
		$r['output'.$i]=sqrt($sigma['output'.$i]);
	}
	// print_r($r);

	// Matriks Ternormalisasi
	$mat_normalisasi = array();
	for ($i=1; $i <= $n_var_input ; $i++) {
		for ($j=0; $j < $n_dmu_efisien; $j++) {
			$id = $id_dep[$j];
			$mat_normalisasi[$id]['input'.$i] = ($tabel[$id]['input'.$i]/$r['input'.$i]);
		}
	}
	for ($i=1; $i <= $n_var_output ; $i++) {
		for ($j=0; $j < $n_dmu_efisien; $j++) {
			$id = $id_dep[$j];
			$mat_normalisasi[$id]['output'.$i] = ($tabel[$id]['output'.$i]/$r['output'.$i]);
		}
	}
	// print_r($mat_normalisasi);
	
	// Matriks Ternormalisasi Terbobot
	$mat_terbobot = array();
	$index = 0;
	for ($i=1; $i <= $n_var_input ; $i++) {
		for ($j=0; $j < $n_dmu_efisien; $j++) {
			$id = $id_dep[$j];
			$mat_terbobot[$id]['input'.$i] = ($mat_normalisasi[$id]['input'.$i]*$variabel[$index]['input'.$i]);
		}
	}
	for ($i=1; $i <= $n_var_output ; $i++) {
		for ($j=0; $j < $n_dmu_efisien; $j++) {
			$id = $id_dep[$j];
			$mat_terbobot[$id]['output'.$i] = ($mat_normalisasi[$id]['output'.$i]*$variabel[$index]['output'.$i]);
		}
	}
	// print_r($mat_terbobot);
	
	// Matriks Solusi Ideal Positif
	$solusi_positif = array();
	for ($i=1; $i <= $n_var_input; $i++) { 
		$max = 0;
	 	for ($j=0; $j < $n_dmu_efisien; $j++) { 
	 		$id = $id_dep[$j];
	 		if ($max < $mat_terbobot[$id]['input'.$i]) {
	 			$max = $mat_terbobot[$id]['input'.$i];
	 		}	 
	 	}
	 	$solusi_positif['input'.$i] = $max;
	}
	for ($i=1; $i <= $n_var_output; $i++) { 
		$max = 0;
	 	for ($j=0; $j < $n_dmu_efisien; $j++) { 
	 		$id = $id_dep[$j];
	 		if ($max < $mat_terbobot[$id]['output'.$i]) {
	 			$max = $mat_terbobot[$id]['output'.$i];
	 		}	 
	 	}
	 	$solusi_positif['output'.$i] = $max;
	}
	//print_r($solusi_positif);

	// Matriks Solusi Ideal Negatif
	$solusi_negatif = array();
	for ($i=1; $i <= $n_var_input; $i++) { 
		$min = 1000;
	 	for ($j=0; $j < $n_dmu_efisien; $j++) { 
	 		$id = $id_dep[$j];
	 		if ($min > $mat_terbobot[$id]['input'.$i]) {
	 			$min = $mat_terbobot[$id]['input'.$i];
	 		}	 
	 	}
	 	$solusi_negatif['input'.$i] = $min;
	}
	for ($i=1; $i <= $n_var_output; $i++) { 
		$min = 1000;
	 	for ($j=0; $j < $n_dmu_efisien; $j++) { 
	 		$id = $id_dep[$j];
	 		if ($min > $mat_terbobot[$id]['output'.$i]) {
	 			$min = $mat_terbobot[$id]['output'.$i];
	 		}	 
	 	}
	 	$solusi_negatif['output'.$i] = $min;
	}
	//print_r($solusi_negatif);

	// Jarak solusi ideal positif
	$ideal_positif = array();
	for ($k=0; $k < $n_dmu_efisien ; $k++) { 
		$id = $id_dep[$k];
		$ideal_positif['dmu'.$id] = 0;
		for ($i=1; $i <= $n_var_input ; $i++) { 
			$ideal_positif['dmu'.$id] += pow(($mat_terbobot[$id]['input'.$i]-$solusi_positif['input'.$i]),2);	
		}
		for ($i=1; $i <= $n_var_output; $i++) { 
			$ideal_positif['dmu'.$id] += pow(($mat_terbobot[$id]['output'.$i]-$solusi_positif['output'.$i]),2);
		}
		$ideal_positif['dmu'.$id]=sqrt($ideal_positif['dmu'.$id]);
	}
	//print_r($ideal_positif);
	
	// Jarak ideal negatif
	$ideal_negatif = array();
	for ($k=0; $k < $n_dmu_efisien ; $k++) { 
		$id = $id_dep[$k];
		$ideal_negatif['dmu'.$id] = 0;
		for ($i=1; $i <= $n_var_input ; $i++) { 
			$ideal_negatif['dmu'.$id] += pow(($mat_terbobot[$id]['input'.$i]-$solusi_negatif['input'.$i]),2);	
		}
		for ($i=1; $i <= $n_var_output; $i++) { 
			$ideal_negatif['dmu'.$id] += pow(($mat_terbobot[$id]['output'.$i]-$solusi_negatif['output'.$i]),2);
		}
		$ideal_negatif['dmu'.$id]=sqrt($ideal_negatif['dmu'.$id]);
	}
	// print_r($ideal_negatif);

	// Nilai preferensi
	for ($i=0; $i < $n_dmu_efisien; $i++) { 
		$id = $id_dep[$i];
		$preferensi['dmu'.$id] = $ideal_negatif['dmu'.$id]/($ideal_negatif['dmu'.$id]+$ideal_positif['dmu'.$id]);
	}
	// print_r($preferensi);

	// Insert ke Database
	for ($i=0; $i < $n_dmu_efisien; $i++) { 
		$id = $id_dep[$i];	
		$nilai_preferensi = $preferensi['dmu'.$id];
		$q_insert = mysqli_query($conn, "INSERT INTO perangkingan (id_departemen, nilai_perangkingan) VALUES ('$id]','$nilai_preferensi')");
	}
	
	header('Location: ../lite/beranda.php?balasan=1');
 ?>