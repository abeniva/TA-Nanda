<?php
	require_once'db_login.php';
	session_start();
	if (isset($_POST['login'])) {
		//Login Berhasil
		$username = test_input($_POST['username']);
		$password = md5($_POST['password']);
		$query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username='".$username."' AND password='".$password."'");
		$query2 = "SELECT * FROM pengguna_khusus WHERE username='".$username."' AND password='".$password."'";
		if(mysqli_num_rows($query) > 0){
			//Username Password Benar
			$data = mysqli_fetch_assoc($query);
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['id'] = $data['id_pengguna'];
			$_SESSION['level'] = $data['level'];
			$_SESSION['id_departemen'] = $data['id_departemen'];
			//Pengguna
			if ($data['level'] == 'm') {
				$_SESSION['user'] = "Manajer";
				header("location: ../lite/beranda.php");
			}
		} elseif (mysqli_query($conn, $query2)) {
			$query2 = mysqli_query($conn, $query2);
			if (mysqli_num_rows($query2) > 0) {
				//Username Password Benar
				$data = mysqli_fetch_assoc($query2);
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;
				$_SESSION['id'] = $data['id_pengguna_khusus'];
				$_SESSION['level'] = $data['level'];
				//Pengguna Khusus
				if ($data['level'] == 'a') {
					$_SESSION['user'] = "Admin";
					header("location: ../lite/beranda.php");		
				}
			} else {
				//Username tidak terdaftar
				$_SESSION['error'] = 'Username tidak terdaftar';
				header("location: ../lite/index.php");	
			}
		} else {
			//Username dan atau password salah
			$_SESSION['error'] = 'Username atau password salah';
			header("location: ../lite/index.php");	
		} 
	}  else {
		//Login Gagal
		$_SESSION['error'] = 'Login Error';
		header("location: ../lite/index.php");
	}

	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}

?>