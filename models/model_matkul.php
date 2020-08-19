<?php 
	class Matakuliah {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data Matakuliah
		public function tampil($kode_mk = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM matakuliah";
			if($kode_mk != null) {
				$sql .= " WHERE kode_mk = $kode_mk";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data MataKuliah
		public function tambah($kode_mk, $nama_mk, $sks) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO matakuliah VALUES('', '$kode_mk', '$nama_mk', '$sks')") or die ($db_error);
		}

		// fungsi edit data MataKuliah
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data MataKuliah
		public function hapus($kode_mk) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM matakuliah WHERE kode_mk = '$kode_mk'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>