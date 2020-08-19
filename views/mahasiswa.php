<?php
	// include models/model_mahasiswa.php
	include "models/model_mahasiswa.php";
	
	$mhs = new Mahasiswa($connection);

	// untuk clean dan mengamankan parameter pada link browser
	if(@$_GET['act'] == '') {
?>
<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<!-- <div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Pelanggan</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Mahasiswa</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No. </th>
													<th>Nim</th>
													<th>Nama Mahasiswa</th>
													<th>Tgl Lahir</th>
													<th>Alamat</th>
													<th>Jenis Kelamin</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data mahasiswa -->
												<?php
													$no = 1;
													$tampil = $mhs->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->Nim; ?></td>
													<td><?php echo $data->Nama_mahasiswa; ?></td>
													<td><?php echo $data->tgl_lahir; ?></td>
													<td><?php echo $data->alamat; ?></td>
													<td><?php echo $data->jenis_kelamin; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_mhs" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->Nim; ?>" data-nama="<?php echo $data->Nama_mahasiswa ?>" data-tgl="<?php echo $data->tgl_lahir; ?>" data-jk="<?php echo $data->jenis_kelamin; ?>" data-alamat="<?php echo $data->alamat; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=mahasiswa&act=del&id=<?php echo $data->Nim; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
															<button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button></a>
														<!-- button hapus -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data mahasiswa -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data mahasiswa -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data mahasiswa -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data Mahasiswa</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="Nim">NIM</label>
													<input type="text" name="Nim" class="form-control" placeholder="Masukan NIM" id="Nim" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nama_mhs">Nama Mahasiswa</label>
													<input type="text" name="Nama_mahasiswa" class="form-control" placeholder="Masukan Nama Mahasiswa" id="Nama_mahasiswa" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
													
													<input type="date" name="tgl_lahir" class="form-control" placeholder="Masukan tanggal" id="tgl_lahir" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="alamat">Alamat</label>
													<textarea name="alamat" class="form-control" placeholder="Masukan alamat" rows="4" id="alamat" required></textarea>
												</div>
												<div class="form-group">
													<label class="control-label" for="jenis_kelamin">Jenis Kelamin</label>
													<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
														<option>-- Pilih --</option>
														<option value="Laki-laki">laki-laki</option>
														<option value="Perempuan">Perempuan</option>
													</select>
												</div>		
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-danger">Reset</button>
												<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
											</div>
										</form>

										<!-- tambah data mahasiswa -->
										<?php
											if(@$_POST['tambah']) {
												$Nim = $connection->conn->real_escape_string($_POST['Nim']);
												$Nama_mahasiswa = $connection->conn->real_escape_string($_POST['Nama_mahasiswa']);
												$tgl_lahir = $connection->conn->real_escape_string($_POST['tgl_lahir']);
												$alamat = $connection->conn->real_escape_string($_POST['alamat']);
												$jenis_kelamin = $connection->conn->real_escape_string($_POST['jenis_kelamin']);
												if(@$_POST['tambah']) {
													$spr->tambah($Nim, $Nama_mahasiswa, $tgl_lahir, $alamat,$jenis_kelamin);
													header("location: ?page=mahasiswa"); // redirect ke form data mahasiswa
												} else {
													echo "<script>alert('Tambah data mahasiswa gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data mahasiswa -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data mahasiswa -->


							<!-- model pop up edit data mahasiswa -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Data Mahasiswa</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<label class="control-label" for="Nim">NIM</label>
													<input type="text" name="Nim" class="form-control" placeholder="Masukan NIM" id="Nim" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nama_mahasiswa">Nama Mahasiswa</label>
													<input type="text" name="Nama_mahasiswa" class="form-control" placeholder="Masukan Nama Mahasiswa" id="Nama_mahasiswa" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
													
													<input type="date" name="tgl_lahir" class="form-control" placeholder="Masukan tanggal" id="tgl_lahir" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="alamat">Alamat</label>
													<textarea name="alamat" class="form-control" placeholder="Masukan alamat" rows="4" id="alamat" required></textarea>
												</div>
												<div class="form-group">
													<label class="control-label" for="jenis_kelamin">Jenis Kelamin</label>
													<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
														<option>-- Pilih --</option>
														<option value="Laki-laki">laki-laki</option>
														<option value="Perempuan">Perempuan</option>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" name="edit" value="Simpan">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end model pop up edit data sopir -->

							<!-- get data sopir dengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan nim #edit_mhs
								$(document).on("click", "#edit_mhs", function() {
									var Nim = $(this).data('Nim');
									var Nama_mahasiswa = $(this).data('Nama_mahasiswa');
									var tgl_lahir = $(this).data('tgl_lahir');
									var alamat_mhs = $(this).data('alamat');
									var jenis_kelamin = $(this).data('jenis_kelamin');
									$("#modal-edit #Nim").val(Nim);
									$("#modal-edit #Nama_mahasiswa").val(Nama_mahasiswa);
									$("#modal-edit #tgl_lahir").val(tgl_lahir);
									$("#modal-edit #jenis_kelamin").val(jenis_kelamin);
									$("#modal-edit #alamat").val(alamat_mhs);
								})

								// proses edit data mahasiswa dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_mahasiswa.php',
											type : 'POST',
											data : new FormData(this),
											contentType : false,
											cache : false,
											processData : false,
											success : function(msg) {
												$('.table').html(msg);
											}
										});
									}));
								})
							</script>

					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
<!-- END MAIN -->
<?php
	} else if(@$_GET['act'] == 'del') {
		// echo "proses delete untuk id : ".$_GET['id'];
		$mhs->hapus($_GET['Nim']);
		// redirect
		header("location: ?page=mahasiswa");
	}