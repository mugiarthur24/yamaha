<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<b>Daftar Produk Keluar</b>
				<span class="text-muted">Daftar Produk Keluar pada masing masing Perusahaan / Cabang</span>
			</div>
			<?php if ($this->ion_auth->in_group(array('admin')) && $users->id_info_pt == '1'): ?>
				<div class="col">
					<a href="<?php echo base_url('index.php/admin/produkkeluar/crtprodukkeluar') ?>" class="btn btn-grd-success btn-sm float-right">Tambah Produk Keluar</a>
				</div>
			<?php endif ?>
		</div>
	</div>
	<div class="card-body">
		<form action="<?php echo base_url('index.php/admin/produkkeluar/index') ?>" method="post">
			<div class="row">
				<div class="col-md-2">
					<input type="text" name="kode_pk" class="form-control" placeholder="masukan Kode Produk Keluar" style="width: 100%" <?php if (!empty($post['kode_pk']) ): ?>
								value="<?php echo $post['kode_pk'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-1">
					<input type="text" name="nm_user" class="form-control" placeholder="nama Karyawan" style="width: 100%" <?php if (!empty($post['nm_user']) ): ?>
								value="<?php echo $post['nm_user'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-2">
					<input type="date" name="tgl_buat" class="form-control" placeholder="masukan Tanggal Buat" style="width: 100%" <?php if (!empty($post['tgl_buat']) ): ?>
								value="<?php echo $post['tgl_buat'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<?php if ($users->id_info_pt =='1'): ?>
					<div class="col-md-2">
						<select name="id_info_pt_asal" class="form-control">
							<?php if (!empty($post['id_info_pt_asal'])): ?>
								<option value="<?php echo $post['id_info_pt_asal'] ?>"><?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$post['id_info_pt_asal'])->nama_info_pt ?></option>
								<option value="">Semua Perusahaan</option>
								<option value="0">Belum Di Setting</option>
							<?php else: ?>
								<option value="">Semua Perusahaan</option>
								<option value="0">Belum Di Setting</option>
							<?php endif ?>
							<?php foreach ($dtpt as $data): ?>
									<option value="<?php echo $data->id_info_pt ?>"><?php echo $data->nama_info_pt ?></option>
							<?php endforeach ?>
						</select>
						<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
					</div>
				<?php endif ?>
				<div class="col-md-2">
					<select name="id_info_pt_tujuan" class="form-control">
						<?php if (!empty($post['id_info_pt_tujuan'])): ?>
							<option value="<?php echo $post['id_info_pt_tujuan'] ?>"><?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$post['id_info_pt_tujuan'])->nama_info_pt ?></option>
							<option value="">Semua Perusahaan</option>
							<option value="0">Belum Di Setting</option>
						<?php else: ?>
							<option value="">Semua Perusahaan</option>
							<option value="0">Belum Di Setting</option>
						<?php endif ?>
						<?php foreach ($dtpt as $data): ?>
							<option value="<?php echo $data->id_info_pt ?>"><?php echo $data->nama_info_pt ?></option>
						<?php endforeach ?>
					</select>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-2">
					<select name="id_status" class="form-control">
						<?php if (!empty($post['id_status'])): ?>
							<option value="<?php echo $post['id_status'] ?>"><?php echo $this->Admin_m->detail_data('status','id_status',$post['id_status'])->nm_status ?></option>
							<option value="">Semua Status</option>
						<?php else: ?>
							<option value="">Semua Status</option>
						<?php endif ?>
							<option value="0">Belum Selesai</option>
							<option value="1">Selesai</option>
					</select>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
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
					<th>Kode P.Keluar</th>
					<th>Pembuat</th>
					<th>Tgl Buat</th>
					<th>Asal</th>
					<th>Tujuan</th>
					<th>Status</th>
					<th></th>
				</tr>
				<?php if ($hasil == TRUE): ?>
					<?php $no = 1+$row ?>
					<?php foreach ($hasil as $data): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td>
								<a href="<?php echo base_url('index.php/admin/produkkeluar/create/'.$data['id_pk']) ?>"><?php echo $data['kode_pk']; ?></a>
							</td>
							<td><?php echo $data['nm_user']; ?></td>
							<td>
								<?php if ($data['tgl_buat'] !== '0000-00-00'): ?>
									<?php echo date('d F Y',strtotime($data['tgl_buat'])); ?>
								<?php else: ?>
									<?php echo "Belum disetting"; ?>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_info_pt_asal'] !=='0'): ?>
									<?php echo substr($this->Admin_m->detail_data('info_pt','id_info_pt',$data['id_info_pt_asal'])->nama_info_pt,0,25).'...' ; ?>
								<?php else: ?>
									<span class="pcoded-badge label label-warning">Belum disetting</span>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_info_pt_tujuan'] !=='0'): ?>
									<?php echo substr($this->Admin_m->detail_data('info_pt','id_info_pt',$data['id_info_pt_tujuan'])->nama_info_pt,0,25).'...' ; ?>
								<?php else: ?>
									<span class="pcoded-badge label label-warning">Belum disetting</span>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_status'] == '1' ): ?>
									<span class="pcoded-badge label label-success">Selesai</span>
								<?php else: ?>
									<span class="pcoded-badge label label-danger">Belum Selesai</span>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_status'] == '1'): ?>
									<a href="#" class="text-secondary">Hapus</a>
								<?php else: ?>
									<a href="<?php echo base_url('index.php/admin/produkkeluar/delpk/'.$data['id_pk']) ?>" class="text-danger">Hapus</a>
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