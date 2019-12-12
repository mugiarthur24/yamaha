<script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js') ?>"></script>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col">
				<div class="media">
				<img src="<?php echo base_url('assets/img/users/'.$users->profile); ?>" width="100px" class="m-3 text-center border border-success rounded-circle">
				  <div class="media-body">
				    <h4 class="m-0 text-info"><?php echo $users->first_name.' '.$users->last_name; ?></h4>
				    <h5 class="m-0"><?php echo $users->username; ?></h5>
				    
				    	Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
				    <br/>
				    <?php foreach ($groups as $gg): ?>
				    	<span class="badge badge-success"><?php echo $gg->name; ?></span>
				    <?php endforeach ?>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mt-4">
	<div class="col-md-4">
		<div class="card ">
			<div class="card-header">
				<h6 class="text-primary font-weight-bold">Edit Profil</h6>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('index.php/admin/profil/proses_edit') ?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<label class="control-label">profil Image</label>
							<div class="box-profil text-center">
								<img id="preview" src="<?php echo base_url('assets/img/users/'.$users->profile); ?>" width="200px" class="border border-success rounded-circle"><br/>
								<input id="uploadBtn" type="file" class="bts-ats" name="profile">
							</div><hr/>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama Lengkap</label>
								<input type="hidden" name="id" value="<?php echo $users->id; ?>">
								<input type="text" class="form-control border-dark" name="first_name" value="<?php echo $users->first_name; ?>" placeholder="Nama Depan">
							</div>
							<div class="form-group">
								<label class="control-label">NIP / Username</label>
								<input type="text" class="form-control border-dark" name="username" value="<?php echo $users->username; ?>" placeholder="Username">
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="text" class="form-control border-dark" name="email" value="<?php echo $users->email; ?>" placeholder="Email">
							</div>
							<div class="form-group">
								<label class="control-label">Company</label>
								<input type="text" class="form-control border-dark" name="company" value="<?php echo $users->company; ?>" placeholder="Company">
							</div>
							<div class="form-group">
								<label class="control-label">Phone</label>
								<input type="text" class="form-control border-dark" name="phone" value="<?php echo $users->phone; ?>" placeholder="Phone">
							</div>
							<span>* Pengaturan perubahan Password Anda, Abaikan jika tidak di gunakan.</span>
							<div class="p-4 border border-dark mb-4 rounded">
								<div class="col">
									<div class="form-group">
										<label>Password</label>
										<input type="password" class="form-control" name="password" placeholder="Password">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label>Ulangi Password</label>
										<input type="password" class="form-control" name="repassword" placeholder="Ulangi Password">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label>Password Lama</label>
										<input type="password" class="form-control" name="oldpassword" placeholder="Masukan Password Lama Anda">
									</div>
								</div>
							</div>
							<button type="submit" name="submit" value="submit" class="btn btn-success mt-4">Simpan Perubahan</button>
						</div>
						
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header"><h6 class="text-primary font-weight-bold">Riwayat Layanan Trx</h6></div>
			<div class="card-body">
				<table class="table" style="font-size: 13px;">
					<tr>
						<td class="text-center">No</td>
						<td class="text-center">Kode Nota</td>
						<td class="text-center">Kode Trx</td>
						<td class="text-center">NIM</td>
						<td class="text-center">Trx</td>
					</tr>
					<?php if ($rlayanan == TRUE): ?>
						<?php $no = 1 ?>
						<?php foreach ($rlayanan as $rlm): ?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td class="text-center"><?php echo $rlm->kode_nota; ?></td>
								<td class="text-center"><?php echo $rlm->kode_transaksi; ?></td>
								<td class="text-center"><?php echo $rlm->nipd; ?></td>
								<td class="text-left"><?php echo $rlm->nm_transaksi; ?></td>
							</tr>
							<?php $no++ ?>
						<?php endforeach ?>
					<?php else: ?>
						<tr>
							<td colspan="text-center" colspan="5">Tidak ada riwayat layanan transaksi</td>
						</tr>
					<?php endif ?>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	document.getElementById("uploadBtn").onchange = function () {
		document.getElementById("uploadFile").value = this.value;
	};
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#uploadBtn").change(function(){
		readURL(this);
	});
</script>