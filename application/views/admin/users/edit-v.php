<div class="card">
	<div class="card-header">
		<b>Edit Karyawan</b>
		<span class="text-muted">Form ubah data karyawan</span>
	</div>
	<div class="card-body">
		<form action="<?php echo base_url('index.php/admin/users/proses_edit/'.$detail->id); ?>" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Depan</label>
								<input type="text" class="form-control" name="first_name" value="<?php echo $detail->first_name ?>" placeholder="Nama Depan" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Belakang</label>
								<input type="text" class="form-control" name="last_name" value="<?php echo $detail->last_name ?>"  placeholder="Nama Belakang">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label class="control-label">Jenis Kelamin</label>
								<select name="jk" class="form-control">
									<?php if ($detail->jk =='L'): ?>
										<option value="L">-- Laki-laki --</option>
										<option value="P">Perempuan</option>
									<?php else: ?>
										<option value="P">-- Perempuan --</option>
										<option value="L">Laki-laki</option>
									<?php endif ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<?php if ($users->id_info_pt =='1'): ?>
								<div class="form-group">
									<label class="control-label">Penempatan</label>
									<select name="id_info_pt" class="form-control">
										<option value="<?php echo $detail->id_info_pt ?>"><?php echo '-- '.$this->Admin_m->detail_data('info_pt','id_info_pt',$detail->id_info_pt)->nama_info_pt.' --'; ?></option>
										<?php foreach ($dtpt as $data): ?>
											<option value="<?php echo $data->id_info_pt ?>"><?php echo $data->nama_info_pt ?></option>
										<?php endforeach ?>
									</select>
								</div>
							<?php else: ?>
								<div class="form-group">
									<label class="control-label">Penempatan</label>
									<input type="hidden" name="id_info_pt" value="<?php echo $detail->id_info_pt ?>">
									<div class="form-control"><?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$detail->id_info_pt)->nama_info_pt; ?></div>
								</div>
							<?php endif ?>
								
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No Hp</label>
								<input type="text" class="form-control" name="phone" value="<?php echo $detail->phone ?>" placeholder="Nomor Handphone" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="email" class="form-control" name="email" value="<?php echo $detail->email ?>" placeholder="Alamat Email" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Password</label>
						<input type="password" class="form-control" name="password" placeholder="Password">
					</div>
					<div class="form-group">
						<label class="control-label">Ulangi Password</label>
						<input type="password" class="form-control" name="repassword" placeholder="Ulangi Password">
					</div>
					<div class="form-group">
						<label class="control-label">Password Lama</label>
						<input type="password" class="form-control" name="oldpassword" placeholder="Password lama anda">
					</div>
				</div>
				<div class="col-md-4">
					<label class="control-label">Foto Profil</label>
					<div class="box-profil">
						<img id="preview" class="border border-primary mb-4" src="<?php echo base_url('assets/img/users/'.$detail->profile); ?>" width="100%">
						<input id="logopt" type="file" class="bts-ats" name="profile">
					</div>
					<div class="form-group" style="margin-top: 30px;">
						<label class="control-label">Hak Akses Sebagai</label><br/>
						<?php foreach ($groups as $gg): ?>
							<span class="pcoded-badge label label-primary">
							<?php if ($this->ion_auth->in_group(array('admin'))): ?>
								<input type="checkbox" name="groups[]" value="<?php echo $gg->id; ?>" 
								<?php foreach ($usergroups as $us): ?>
									<?php if ($gg->id==$us){echo('checked');} ?>
								<?php endforeach ?>
								> <?php if ($gg->name == 'members'): ?>
									<?php echo "Karyawan"; ?>
								<?php else: ?>
									<?php echo $gg->name; ?>
								<?php endif ?>
							</span>
							<?php else: ?>
								<span class="pcoded-badge label label-primary">
								<?php if ($gg->id !=='1'): ?>
									<input type="checkbox" name="groups[]" value="<?php echo $gg->id; ?>" 
									<?php foreach ($usergroups as $us): ?>
										<?php if ($gg->id==$us){echo('checked');} ?>
									<?php endforeach ?>
									> <?php if ($gg->name == 'members'): ?>
										<?php echo "Karyawan"; ?>
									<?php else: ?>
										<?php echo $gg->name; ?>
									<?php endif ?>
								<?php endif ?>
							<?php endif ?>
							</span>
						<?php endforeach ?>
					</div>
				</div><hr/>
				<div class="col-md-12">
					<button class="btn btn-success btn-sm" >Ubah Data Karyawan</button>
				</div>
			</div>
		</form>
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