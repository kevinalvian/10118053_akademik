<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// armada.php
	// include models/model_dosen.php
	include "../models/model_dosen.php";
	$dsn = new Dosen($connection);

	$NIP = $_POST['NIP'];
	$nama_dosen = $connection->conn->real_escape_string($_POST['Nama_dosen']);
	$dsn->edit("UPDATE dosen SET NIP = '$NIP', Nama_dosen = '$nama_dosen' WHERE NIP = '$NIP'");
	// redirect
	echo "<script>window.location='?page=dosen';</script>";
?>