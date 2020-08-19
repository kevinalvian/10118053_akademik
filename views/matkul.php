<?php
	// include models/model_jadwal.php
	include "models/model_matkul.php";
	
	$mk = new Matakuliah($connection);

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
							<h3 class="panel-title">Jadwal</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data MataKuliah</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>Kode MataKuliah</th>
													<th>Nama MataKuliah</th>
													<th>SKS</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data matkul -->
												<?php
													$no = 1;
													$tampil = $mk->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->kode_mk; ?></td>
													<td><?php echo $data->nama_mk; ?></td>
													<td><?php echo $data->sks; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_matkul" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->kode_mk; ?>" data-tgl="<?php echo $data->tgl_berangkat; ?>" data-armada="<?php echo $data->armada; ?>" data-jumlah="<?php echo $data->jumlah_kursi; ?>" data-jurusan="<?php echo $data->jurusan; ?>" 	data-sopir="<?php echo $data->sopir; ?>" data-harga="<?php echo $data->harga_tiket; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=jadwal&act=del&id=<?php echo $data->kode_mk; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
															<button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button></a>
														<!-- button hapus -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data matkul -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data matkul -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data jadwal -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data MataKuliah</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="kode_mk">Kode Matakuliah</label>
													<input type="text" name="kode_mk" class="form-control" placeholder="Masukan kode" id="kode_mk" required>
												</div>

												<div class="form-group">
													<label class="control-label" for="nama_mk">Nama Matakuliah</label>
													<input type="text" name="nama_mk" class="form-control" placeholder="Masukan nama matakuliah" id="nama_mk" >
													
												</div>
												
												<div class="form-group">
													<label class="control-label" for="sks">Jumlah SKS</label>
													<input type="number" name="sks" class="form-control"  id="sks" >
													
												</div>
							
												
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-danger">Reset</button>
												<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
											</div>
										</form>

										<!-- tambah data matkul -->
										<?php
											if(@$_POST['tambah']) {
												$kode_mk = $connection->conn->real_escape_string($_POST['kode_mk']);
												$nama_mk = $connection->conn->real_escape_string($_POST['nama_mk']);
												$sks = $connection->conn->real_escape_string($_POST['sks']);
												if(@$_POST['tambah']) {
													$jdw->tambah($tgl_berangkat, $armada, $jumlah_kursi, $jurusan, $sopir, $harga_tiket);
													header("location: ?page=matkul"); // redirect ke form data matkul
												} else {
													echo "<script>alert('Tambah data matkul gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data jadwal -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data matkul -->


							<!-- model pop up edit data matkul -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Data Matakuliah</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="form-group">
													<label class="control-label" for="kode_mk">Kode Matakuliah</label>
													<input type="text" name="kode_mk" class="form-control" placeholder="Masukan kode" id="kode_mk" required>
												</div>

												<div class="form-group">
													<label class="control-label" for="nama_mk">Nama Matakuliah</label>
													<input type="text" name="nama_mk" class="form-control" id="nama_mk" >
													
												</div>
												
												<div class="form-group">
													<label class="control-label" for="sks">Jumlah SKS</label>
													<input type="number" name="sks" class="form-control" id="sks" >
												</div>	
													
												
												
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" name="edit" value="Simpan">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end model pop up edit data matkul -->

							<!-- get data jadwal dengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan kode_mk #edit_jdw
								$(document).on("click", "#edit_jdw", function() {
									var kode_mk = $(this).data('kode_mk');
									var nama_mk = $(this).data('nama_mk');
									var sks = $(this).data('sks');
									$("#modal-edit #kode_mk").val(kode_mk);
									$("#modal-edit #nama_mk").val(nama_mk);
									$("#modal-edit #sks").val(sks);
									
								})

								// proses edit data matkul dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_matkul.php',
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
		$mk->hapus($_GET['kode_mk']);
		// redirect
		header("location: ?page=matkul");
	}