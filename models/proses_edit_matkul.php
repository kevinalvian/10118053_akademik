<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// jadwal.php
	// include models/model_matkul.php
	include "../models/model_matkul.php";
	$mk = new Matakuliah($connection);

	$kode_mk = $_POST['kode_mk'];
	$nama_mk = $connection->conn->real_escape_string($_POST['nama_mk']);
	$sks = $connection->conn->real_escape_string($_POST['sks']);


	$mk->edit("UPDATE matakuliah SET nama_mk = '$nama_mk', sks = '$sks' WHERE kode_mk = '$kode_mk'");
	// redirect
	echo "<script>window.location='?page=jadwal';</script>";
?>