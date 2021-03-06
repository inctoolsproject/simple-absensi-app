<?php include 'koneksi.php'; ?>
<?php
if($_SESSION['role'] === 'Pimpinan Unit' || $_SESSION['role'] === 'Pimpinan Cabang' || $_SESSION['role'] === 'Pimpinan Final' || $_SESSION['role'] === 'admin'){
$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM tb_lembur WHERE id_lembur = '$id'");
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php'; ?>
</head>
<body>
	<div id="app">
		<div class="main-wrapper">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<?php include 'menu/nav.php'; ?>
			</nav>
			<div class="main-sidebar">
				<aside id="sidebar-wrapper">
					<?php include 'menu/aside.php'; ?>
				</aside>
			</div>
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>Update Lembur</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="produk">Lembur</a></div>
							<div class="breadcrumb-item">Update Lembur</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input type="hidden" name="id" value="<?= $row['id_lembur'] ?>">
														<input type="hidden" name="nama" value="<?= $row['nama']?>">
														<label for="nama">Nama</label>
														<select class="form-control select2" name="nama" id="nama" <?php if($_SESSION['role'] !== 'hr'){ echo "disabled";} ?>>
															<option value="<?= $row['nama']?>"><?= $row['nama'] ?></option>
															<?php
																$posisi = $conn->prepare("SELECT nama, posisi FROM tb_user WHERE role NOT IN ('Super Admin', 'admin')");
																$posisi->execute();
																while($data = $posisi->fetch(PDO::FETCH_ASSOC)){
															?>
																<option value="<?= $data['nama']; ?> <?= $data['posisi'] ?>"><?= $data['nama'] ?> (<?= $data['posisi'] ?>)</option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="tanggal_lembur">Tanggal Lembur</label>
														<input type="date" class="form-control" name="tanggal_lembur" id="tanggal_lembur" value="<?= $row['tanggal'] ?>" autocomplete="off" maxlength="100" autofocus="">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="jam_mulai">Jam Mulai</label>
														<input type="time" class="form-control" value="<?= $row['jam_mulai'] ?>" name="jam_mulai" id="jam_mulai" autocomplete="off" >
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="jam_selesai">Jam Selesai</label>
														<input type="time" class="form-control" value="<?= $row['jam_selesai'] ?>" name="jam_selesai" id="jam_selesai" autocomplete="off" placeholder="Masukkan Harga">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label for="aktivitas">Aktivitas</label>
														<textarea class="form-control text-left" name="aktivitas" id="aktivitas" placeholder="Tuliskan Aktivitas" style="height: 125px;">
														<?= $row['aktivitas'] ?>
														</textarea>
													</div>
												</div>
												<?php if($_SESSION['role'] === 'Pimpinan Unit'): ?>
												<div class="col-md-6">
													<img src="assets/images/approval/<?= $row['approval_unit'] ?>" alt="Approval unit" style="width: 150px; height: 150px;">
													<div class="form-group">
														<label for="tanda1">Tanda Tangan Approval 1</label>
														<input type="file" class="form-control" value="<?= $row['approval_unit'] ?>" name="tanda1" id="tanda1" accept="image/*">
														<input type="file" class="form-control" value="<?= $row['approval_cabang'] ?>" name="tanda2" id="tanda2" accept="image/*" style="display:none">
														<input type="file" class="form-control" value="<?= $row['approval_final'] ?>" name="tanda3" id="tanda3" accept="image/*" style="display: none">
													</div>
												</div>
												<?php endif; ?>
												<?php if($_SESSION['role'] === 'Pimpinan Cabang'): ?>
												<div class="col-md-6">
													<img src="assets/images/approval/<?= $row['approval_cabang'] ?>" alt="Approval unit" style="width: 150px; height: 150px;">
													<div class="form-group">
														<label for="tanda2">Tanda Tangan Approval 2</label>
														<input type="file" class="form-control" value="<?= $row['approval_unit'] ?>" name="tanda1" id="tanda1" accept="image/*" style="display:none">
														<input type="file" class="form-control" value="<?= $row['approval_cabang'] ?>" name="tanda2" id="tanda2" accept="image/*">
														<input type="file" class="form-control" value="<?= $row['approval_final'] ?>" name="tanda3" id="tanda3" accept="image/*" style="display: none">
													</div>
												</div>
												<?php endif; ?>
												<?php if($_SESSION['role'] === 'Pimpinan Final'): ?>
												<div class="col-md-12">
													<img src="assets/images/approval/<?= $row['approval_final'] ?>" alt="Approval unit" style="width: 150px; height: 150px;">
													<div class="form-group">
														<label for="tanda3">Tanda Tangan Approval Final</label>
														<input type="file" class="form-control" value="<?= $row['approval_unit'] ?>" name="tanda1" id="tanda1" accept="image/*" style="display: none">
														<input type="file" class="form-control" value="<?= $row['approval_cabang'] ?>" name="tanda2" id="tanda2" accept="image/*" style="display:none">
														<input type="file" class="form-control" value="<?= $row['approval_final'] ?>" name="tanda3" id="tanda3" accept="image/*">
													</div>
												</div>
												<?php endif;?>
												<?php if($_SESSION['role'] === 'admin'): ?>
													<div class="col-md-12">
														<div class="form-group">
															<input type="file" class="form-control" value="<?= $row['approval_unit'] ?>" name="tanda1" id="tanda1" accept="image/*" style="display: none">
															<input type="file" class="form-control" value="<?= $row['approval_cabang'] ?>" name="tanda2" id="tanda2" accept="image/*" style="display:none">
															<input type="file" class="form-control" value="<?= $row['approval_final'] ?>" name="tanda3" id="tanda3" accept="image/*" style="display: none">
														</div>
													</div>
												<?php endif; ?>
											</div>
											<div class="row">
												<div class="col-md-12">
													<a href="lembur" class="btn btn-danger">Kembali</a>
													<button type="submit" class="btn btn-primary float-right">Simpan</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<footer class="main-footer">
				<?php include 'menu/footer.php'; ?>
			</footer>
		</div>
	</div>
	<?php include 'menu/script.php'; ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/update-lembur.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(response) {
						var dataresponse = JSON.parse(response);
						console.log(dataresponse);
						if(dataresponse.status == "1") {
							window.location.href='lembur'
						}else {
							swal('Peringatan', 'Gagal menambah data', 'error');
						}
					}
				});
				return false;
			});
		});
	</script>
</body>
</html>
	<?php } else {
		header("Location: beranda");
	} ?>