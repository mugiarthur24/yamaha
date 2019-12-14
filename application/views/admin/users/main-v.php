<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<b>Daftar Karyawan Perusahaan</b>
				<span class="text-muted">Daftar Karyawan Perusahaan dan sub perusahaan</span>
			</div>
			<?php if ($this->ion_auth->in_group(array('admin'))): ?>
				<div class="col">
					<a href="<?php echo base_url('index.php/admin/users/create') ?>" class="btn btn-grd-success btn-sm float-right">Tambah Karyawan Perusahaan</a>
				</div>
			<?php endif ?>
		</div>
	</div>
	<div class="card-body">
		<form action="<?php echo base_url('index.php/admin/users/index') ?>" method="post">
			<div class="row">
				<div class="col-md-5">
					<input type="text" name="string" class="form-control" placeholder="masukan Nama Karyawan" style="width: 100%" <?php if (!empty($post['string']) ): ?>
								value="<?php echo $post['string'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-5">
					<select name="id_info_pt" class="form-control">
						<?php if (!empty($post['id_info_pt'])): ?>
							<option value="<?php echo $post['id_info_pt'] ?>"><?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$post['id_info_pt'])->nama_info_pt ?></option>
							<option value="">Semua Perusahaan</option>
						<?php else: ?>
							<option value="">Semua Perusahaan</option>
						<?php endif ?>
						<?php foreach ($dtpt as $data): ?>
							<option value="<?php echo $data->id_info_pt ?>"><?php echo $data->nama_info_pt ?></option>
						<?php endforeach ?>
					</select>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-2">
					<button type="submit" name="submit" value="submit" class="btn btn-success btn-sm">Cari</button>
				</div>
			</div>
		</form>
		<div class="table-responsive">
			<table class="table" style="font-size: 13px;">
				<tr>
					<th>No</th>
					<th>ID</th>
					<th>Nama Karyawan</th>
					<th>Jk</th>
					<th>Jab</th>
					<th>PT</th>
					<th>Daerah</th>
					<th>Hp</th>
					<th>Status</th>
				</tr>
				<?php $no = 1+$row ?>
				<?php foreach ($hasil as $data): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data['username']; ?></td>
						<td><a href="<?php echo base_url('index.php/admin/users/detail/'.$data['id']) ?>"><b><?php echo $data['first_name']; ?></b></a></td>
						<td><?php echo $data['jk']; ?></td>
						<td>
							<?php 
								$getug = $this->ion_auth->get_users_groups($data['id'])->result();
								foreach ($getug as $key) {
									if ($key->id =='1') {
										echo "<span class='pcoded-badge label label-success'>".$key->name."</span>";
									}else{
										if ($key->id == '2') {
											echo "<span class='pcoded-badge label label-primary'>Karyawan</span>";
										}else{
											echo "<span class='pcoded-badge label label-primary'>".$key->name."</span>";
										}
									}
								}
							?>
						</td>
						<td><?php echo substr($data['nama_info_pt'],0,35).' ...' ; ?></td>
						<td><b><?php echo $data['kode_pt']; ?></b></td>
						<td><?php echo $data['phone']; ?></td>
						<td>
							<?php if ($data['active'] == '1' ): ?>
								<span class="pcoded-badge label label-success">Aktif</span>
							<?php else: ?>
								<span class="pcoded-badge label label-danger">Nonaktif</span>
							<?php endif ?>
						</td>
					</tr>
					<?php $no++ ?>
				<?php endforeach ?>
			</table>
		</div>
		<div class="row">
			<div class="col">
				<?php echo $pagination; ?>
			</div>
		</div>
	</div>
</div>