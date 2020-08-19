<?php 
	class Dosen {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data dosen
		public function tampil($NIP = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM dosen";
			if($NIP != null) {
				$sql .= " WHERE NIP = $NIP";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data dosen
		public function tambah($NIP, $Nama_dosen) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO dosen VALUES('', '$NIP', '$Nama_dosen')") or die ($db_error);
		}

		// fungsi edit data dosen
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data dosen
		public function hapus($NIP) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM dosen WHERE NIP = '$NIP'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>