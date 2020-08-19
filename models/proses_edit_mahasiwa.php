<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// sopir.php
	// include models/model_sopir.php
	include "../models/model_mahasiswa.php";
	$mhs = new Mahasiswa($connection);

	$Nim = $_POST['Nim'];
	$Nama_mahasiswa = $connection->conn->real_escape_string($_POST['Nama_mahasiswa']);
	$tgl_lhr = $connection->conn->real_escape_string($_POST['tgl_lahir']);
	$alamat = $connection->conn->real_escape_string($_POST['alamat']);
	$jenis_kelamin = $connection->conn->real_escape_string($_POST['jenis_kelamin']);

	$spr->edit("UPDATE mahasiswa SET Nim='$Nim',Nama_mahasiswa = '$Nama_mahasiswa', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat' WHERE Nim = '$Nim'");
	// redirect
	echo "<script>window.location='?page=mahasiswa';</script>";
?>