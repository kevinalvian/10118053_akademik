<?php 
	class Mahasiswa {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data mahasiswa
		public function tampil($Nim = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM mahasiswa";
			if($Nim != null) {
				$sql .= " WHERE Nim  = $Nim";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data mahasiswa
		public function tambah($Nim,$Nama_mahasiswa, $tgl_lahir, $alamat, $jenis_kelamin) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO mahasiswa VALUES('','$Nim', '$Nama_mahasiswa', '$tgl_lahir', '$alamat', '$jenis_kelamin')") or die ($db_error);
		}

		// fungsi edit data mahasiswa
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data mahasiswa
		public function hapus($Nim) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM mahasiswa WHERE Nim = '$Nim'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>