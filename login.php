<?php
session_start();
include "inc/koneksi.php";
if(@$_SESSION['admin'] || @$_SESSION['mahasiswa']){
  header("location: index.php");
}else{
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

    <title>Login | OpenDonasi</title>
    <link rel="icon" type="image/png" sizes="96x96" href="img/donasi.png">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="login-img">
            <img src="img/donasi.png">
          </div>
        </div>
        <div class="col-md-6">
          <div class="wrapper-login"style="margin: 150px auto;">
            <form action="#" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input class="form-control"  type="text" name="user" placeholder="Username ..">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="pass" placeholder="Password ..">
              </div>
              <input type="submit" class="btn btn-primary btn-login "name="login" value="Login"></button>
              <div class="form-group">
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
              </div>   
            </form>
            <?php
            $user = @$_POST['user'];
            $pass = @$_POST['pass'];
            $login = @$_POST['login'];
            

            if($login) {
               $sql = mysqli_query($koneksi,"select * from user where username = '$user' and password = '$pass' ") or die (mysqli_error());
               $data = mysqli_fetch_array($sql);
                $cek = mysqli_num_rows($sql);
                
                if($cek >= 1){
                  if($data['role'] =="admin"){
                    @$_SESSION['admin'] = $data['id_user'];
                    header( "location: index.php");
                  } else if ($data['role'] =="mahasiswa") {
                    @$_SESSION['mahasiswa'] = $data['id_user'];
                    header( "location: index.php");
                  }
                  }else{
                  echo "Login Gagal";
                  
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
}
?>
