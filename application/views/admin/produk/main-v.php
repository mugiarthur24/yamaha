<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<b>Daftar Produk</b>
				<span class="text-muted">Daftar Produk pada masing masing Perusahaan / Cabang</span>
			</div>
		</div>
	</div>
	<div class="card-body">
		<form action="<?php echo base_url('index.php/admin/produk/index') ?>" method="post">
			<div class="row">
				<div class="col-md-3">
					<input type="text" name="no_rangka" class="form-control" placeholder="masukan nomor rangka produk" style="width: 100%" <?php if (!empty($post['no_rangka']) ): ?>
								value="<?php echo $post['no_rangka'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-2">
					<input type="text" name="no_mesin" class="form-control" placeholder="masukan nomor mesin produk" style="width: 100%" <?php if (!empty($post['no_mesin']) ): ?>
								value="<?php echo $post['no_mesin'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<!-- <div class="col-md-1">
					<select name="id_jenis" class="form-control">
						<?php if (!empty($post['id_jenis'])): ?>
							<option value="<?php echo $post['id_jenis'] ?>"><?php echo $this->Admin_m->detail_data('jenis','id_jenis',$post['id_jenis'])->nm_jenis ?></option>
							<option value="">Semua Jenis Produk</option>
						<?php else: ?>
							<option value="">Semua Jenis Produk</option>
						<?php endif ?>
						<?php foreach ($jenis as $data): ?>
							<option value="<?php echo $data->id_jenis ?>"><?php echo $data->nm_jenis ?></option>
						<?php endforeach ?>
					</select>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div> -->
				<!-- <div class="col-md-2">
					<select name="id_merk" class="form-control">
						<?php if (!empty($post['id_merk'])): ?>
							<option value="<?php echo $post['id_merk'] ?>"><?php echo $this->Admin_m->detail_data('merk','id_merk',$post['id_merk'])->nm_merk ?></option>
							<option value="">Semua Merk Produk</option>
						<?php else: ?>
							<option value="">Semua Merk Produk</option>
						<?php endif ?>
						<?php foreach ($merk as $data): ?>
							<option value="<?php echo $data->id_merk ?>"><?php echo $data->nm_merk ?></option>
						<?php endforeach ?>
					</select>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div> -->
				<div class="col-md-2">
					<select name="id_type" class="form-control">
						<?php if (!empty($post['id_type'])): ?>
							<option value="<?php echo $post['id_type'] ?>"><?php echo $this->Admin_m->detail_data('type','id_type',$post['id_type'])->nm_type ?></option>
							<option value="">Semua Type Produk</option>
						<?php else: ?>
							<option value="">Semua Type Produk</option>
						<?php endif ?>
						<?php foreach ($type as $data): ?>
							<option value="<?php echo $data->id_type ?>"><?php echo $data->nm_type ?></option>
						<?php endforeach ?>
					</select>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-2">
					<select name="id_info_pt" class="form-control">
						<?php if (!empty($post['id_info_pt'])): ?>
							<option value="<?php echo $post['id_info_pt'] ?>"><?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$post['id_info_pt'])->nama_info_pt ?></option>
							<option value="">Semua Daerah</option>
						<?php else: ?>
							<option value="">Semua Daerah</option>
						<?php endif ?>
						<?php foreach ($dtpt as $data): ?>
							<option value="<?php echo $data->id_info_pt ?>"><?php echo $data->kode_pt ?></option>
						<?php endforeach ?>
					</select>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-2">
					<select name="id_status" class="form-control">
						<?php if (!empty($post['id_status'])): ?>
							<option value="<?php echo $post['id_status'] ?>">
								<?php if ($post['id_status'] == '0'): ?>
									Tidak tersedia
								<?php endif ?>
								<?php if ($post['id_status'] == '1'): ?>
									Tersedia
								<?php endif ?>
								<?php if ($post['id_status'] == '2'): ?>
									Terjual
								<?php endif ?>
							</option>
							<option value="">Semua Status</option>
						<?php else: ?>
							<option value="">Semua Status</option>
						<?php endif ?>
						<option value="0">Tidak tersedia</option>
						<option value="1">Tersedia</option>
						<option value="2">Terjual</option>
					</select>
				</div>
				<div class="col-md-1">
					<button type="submit" name="submit" value="submit" class="btn btn-success btn-sm">Cari</button>
				</div>
			</div>
		</form>
		<div class="table-responsive mt-2">
			<table class="table" style="font-size: 13px;">
				<tr>
					<th>No</th>
					<th>No Rangka,No Mesin</th>
					<th>Type,Warna</th>
					<th>Nama Outlet</th>
					<th>Harga</th>
					<th>Status</th>
				</tr>
				<?php if ($hasil == TRUE): ?>
					<?php $no = 1+$row ?>
					<?php foreach ($hasil as $data): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['no_rangka']; ?><br/><?php echo $data['no_mesin']; ?></td>
							<td><?php echo $data['nm_type']; ?> / <?php echo ucfirst($data['warna']); ?><br/><?php echo $data['no_faktur']; ?></td>
							<td><?php echo $data['nama_info_pt']; ?> - <?php echo $data['kode_pt']; ?></td>
							<td><?php echo 'Rp.'.number_format($data['hrg_jual']); ?></td>
							<td>
								<?php if ($data['id_status'] == '1' ): ?>
									<span class="pcoded-badge label label-info">Tersedia</span>
								<?php else: ?>
									<?php if ($data['id_status'] == '0'): ?>
										<span class="pcoded-badge label label-danger">Tidak Tersedia</span>
									<?php else: ?>
										<span class="pcoded-badge label label-success">Terjual</span>
									<?php endif ?>
								<?php endif ?>
							</td>
						</tr>
						<?php $no++ ?>
					<?php endforeach ?>
				<?php else: ?>
					<tr><td colspan="8" class="text-center">Tidak ada data ditemukan</td></tr>
				<?php endif ?>
			</table>
		</div>
		<div class="row">
			<div class="col">
				<?php echo $pagination; ?>
			</div>
		</div>
	</div>
</div>