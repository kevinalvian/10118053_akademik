<?php


	// include models/model_armada.php
	include "models/model_dosen.php";

	$dsn = new Dosen($connection);

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
							<h3 class="panel-title">Armada</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Dosen</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>NIP</th>
													<th>Nama Dosen</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data dosen -->
												<?php
													$no = 1;
													$tampil = $dsn->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->NIP; ?></td>
													<td><?php echo $data->Nama_dosen; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_dsn" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->NIP; ?>" data-nama="<?php echo $data->Nama_dosen; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=armada&act=del&id=<?php echo $data->NIP; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
															<button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button></a>
														<!-- button hapus -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data dosen -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data dosen -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data dosen -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data Dosen</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="NIP">NIP</label>
													<input type="text" name="NIP" class="form-control" placeholder="Masukan NIP" id="NIP" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nama_dosen">Nama Dosen</label>
													<input type="text" name="Nama_dosen" class="form-control" placeholder="Masukan Nama dosen" id="Nama_dosen" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-danger">Reset</button>
												<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
											</div>
										</form>

										<!-- tambah data dosen -->
										<?php
											if(@$_POST['tambah']) {
												$NIP = $connection->conn->real_escape_string($_POST['NIP']);
												$Nama_dosen = $connection->conn->real_escape_string($_POST['Nama_dosen']);
												
												if(@$_POST['tambah']) {
													$dsn->tambah($NIP, $Nama_dosen);
													header("location: ?page=dosen"); // redirect ke form data dosen
												} else {
													echo "<script>alert('Tambah data dosen gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data dosen -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data dosen -->


							<!-- model pop up edit data dosen -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Dosen</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<label class="control-label" for="NIP">NIP</label>
													
													<input type="text" name="NIP" class="form-control" placeholder="Masukan NIP" id="NIP" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nama_dosen">Nama Dosen</label>
													<input type="text" name="Nama_dosen" class="form-control" placeholder="Masukan Nama Dosen" id="Nama_dosen" required>
												</div>												
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" name="edit" value="Simpan">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end model pop up edit data dosen-->

							<!-- get data dosendengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan id #edit_dsn
								$(document).on("click", "#edit_dsn", function() {
									var NIP = $(this).data('NIP');
									var Nama_dosen = $(this).data('Nama_dosen');
									$("#modal-edit #NIP").val(NIP);
									$("#modal-edit #Nama_dosen").val(Nama_dosen);
									
								})

								// proses edit data dosen dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_dosen.php',
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
		$dsn->hapus($_GET['NIP']);
		// redirect
		header("location: ?page=Dosen");
	}
