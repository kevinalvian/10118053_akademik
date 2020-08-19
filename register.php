<?php
	// include models/model_pelanggan.php
	include "models/model_pengguna.php";



    if(isset($_POST['register'])){

      // filter data yang diinputkan
      $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
      $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
      // enkripsi password
      $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
      
  
  
      // menyiapkan query
      $sql = "INSERT INTO users (nama, username, password,role) 
              VALUES (:nama, :username,  :password, :role)";
      $stmt = $db->prepare($sql);
  
      // bind parameter ke query
      $params = array(
          ":nama" => $name,
          ":username" => $username,
          ":password" => $password,
          ":role" => $role
      );
  
      // eksekusi query untuk menyimpan ke database
      $saved = $stmt->execute($params);
  
      // jika query simpan berhasil, maka user sudah terdaftar
      // maka alihkan ke halaman login
      if($saved) header("Location: login.php");
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <title>Register | Open Donasi</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
      <div class="col-md-6">
          <div class="login-img">
             <img src="img/donasi.png">
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="wrapper-login ">
            <form action="#" method="post">
              <div class="form-group">
              <h1>Form Register </h1>
                <label for="exampleInputEmail1">Nama</label>
                <input class="form-control"  type="text" name="nama" placeholder="Nama .." required="required">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input class="form-control"  type="text" name="username" placeholder="Username .." required="required">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password .." required="required">
              </div>
              <div class="form-group">
                <label class="control-label" for="role">Role</label>
                <select class="form-control" name="role" id="role" required>
                  <option>-- Pilih --</option>
                  <option value="mahasiswa">Mahasiswa</option>
                 
                </select>
              </div>
              <input type="submit" class="btn btn-primary btn-login "name="register" value="Register"></button>
              <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </form>
            <?php
          		if(@$_POST['register']) {
								$nama = $connection->conn->real_escape_string($_POST['nama']);
						  	$username = $connection->conn->real_escape_string($_POST['username']);
								$password = $connection->conn->real_escape_string($_POST['password']);
							  $role = $connection->conn->real_escape_string($_POST['role']);
										if(@$_POST['tambah']) {
										  $pengguna->tambah($nama, $username, $password, $role);
											header("location: pengguna.php?berhasildaftar"); // redirect ke menu login
										} else {
											echo "<script>alert('Tambah data pelanggan gagal!')</script>";
											}
							}
            ?>
          </div>
        </div>
      </div>
    </div>
 </body>
 </html>
<?php

?>
