<div class="card">
	<div class="card-header">
		<b>Daftar Perusahaan</b>
		<span class="text-muted">Daftar Perusahaandan sub perusahaan</span>
		<?php if ($this->ion_auth->in_group(array('admin'))): ?>
			<div class="card-header-right">
				<a href="" class="btn btn-grd-success btn-sm">Tambah Perusahaan</a>
			</div>
		<?php endif ?>
		
	</div>
	<div class="card-body">
		<form action="<?php echo base_url('index.php/admin/setting/index') ?>" method="post">
			<div class="row">
				<div class="col-md-5">
					<input type="text" name="string" class="form-control" placeholder="masukan Nama Perusahaan / Cabang" style="width: 100%" <?php if (!empty($post['string']) ): ?>
								value="<?php echo $post['string'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-5">
					<input type="text" name="kode_pt" class="form-control" placeholder="masukan Nama Daerah" style="width: 100%" <?php if (!empty($post['kode_pt']) ): ?>
								value="<?php echo $post['kode_pt'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-2">
					<button type="submit" name="submit" value="submit" class="btn btn-success btn-sm">Cari</button>
				</div>
			</div>
		</form>
		<table class="table" style="font-size: 13px;">
			<tr>
				<th>No</th>
				<th>Nama Perusahaan</th>
				<th>Daerah</th>
				<th>Alamat</th>
				<th>Kontak Utama</th>
				<th>Status</th>
			</tr>
			<?php $no = 1+$row ?>
			<?php foreach ($hasil as $data): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><a href="<?php echo base_url('index.php/admin/setting/detail/'.$data['id_info_pt']) ?>"><?php echo $data['nama_info_pt']; ?></a></td>
					<td><span class="pcoded-badge label label-primary"><?php echo $data['kode_pt']; ?></span></td>
					<td><?php echo $data['alamat_pt']; ?></td>
					<td><?php echo $data['kontak_1']; ?></td>
					<td>
						<?php if ($data['id_status'] !== '1' ): ?>
							<span class="pcoded-badge label label-success">Aktif</span>
						<?php else: ?>
							<span class="pcoded-badge label label-danger">Nonaktif</span>
						<?php endif ?>
					</td>
				</tr>
				<?php $no++ ?>
			<?php endforeach ?>
		</table>
		<div class="row">
			<div class="col">
				<?php echo $pagination; ?>
			</div>
		</div>
	</div>
</div>