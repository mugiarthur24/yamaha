<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<b>Tambah Produk Keluar</b>
				<span class="text-muted">Tambah Produk Keluar pada masing masing Perusahaan / Cabang</span>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<b>Daftar Barang Keluar</b>
						<span class="text-muted">Daftar Barang pada nota</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<?php if ($barang == TRUE): ?>
				<table class="table">
					<tr>
						<th>No</th>
						<th>Type</th>
						<th>Cc</th>
						<th>Warna</th>
						<th>Stok</th>
						<th>Input</th>
						<th></th>
					</tr>
					<?php $no = 1 ?>
					<?php foreach ($barang as $data): ?>
						<?php if ($users->id_info_pt == '1'): ?>
							<form action="<?php echo base_url('index.php/admin/produkkeluar/updatelistbarang/'.$data->id_brg_pk) ?>" method ="post">
								<tr>
									<td><?php echo $no; ?><input type="hidden" name="id_pk" value="<?php echo $detail->id_pk ?>"></td>
									<td><?php echo $data->nm_type; ?> <input type="hidden" name="id_brg_pk" value="<?php echo $data->id_brg_pk ?>"></td>
									<td>
										<input type="text" class="form-control form-control-sm" name="cc" <?php if ($data->cc == TRUE): ?>
										value="<?php echo $data->cc ?>"
										<?php else: ?>
											value="0"
										<?php endif ?>>
									</td>
									<td>
										<input type="text" class="form-control form-control-sm" name="warna" <?php if ($data->warna == TRUE): ?>
										value="<?php echo $data->warna ?>"
										<?php else: ?>
											value="-"
										<?php endif ?>>
									</td>
									<td>
										<input type="text"  class="form-control form-control-sm"name="jml_brg" <?php if ($data->warna == TRUE): ?>
										value="<?php echo $data->jml_brg ?>"
										<?php else: ?>
											value="0"
										<?php endif ?> onchange="this.form.submit()">
									</td>
									<td><label class="badge badge-warning"><?php echo $data->jml_input; ?></label></td>
									<td><a href="<?php echo base_url('index.php/admin/produkkeluar/addsubproduk/'.$detail->id_pk.'/'.$data->id_brg_pk) ?>" class="text-info">Detail</a></td>
									<td>
										<?php if ($data->jml_input >0): ?>
											<a href="#" class="text-secondary">Hapus</a>
										<?php else: ?>
											<a href="<?php echo base_url('index.php/admin/produkkeluar/delproduk/'.$detail->id_pk.'/'.$data->id_brg_pk) ?>" class="text-danger">Hapus</a>
										<?php endif ?>
									</td>
								</tr>
							</form>
						<?php else: ?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $data->nm_type; ?></td>
								<td><?php echo $data->cc; ?></td>
								<td><?php echo $data->warna; ?></td>
								<td><?php echo $data->jml_brg; ?></td>
								<td><?php echo $data->jml_input; ?></td>
								<td><a href="<?php echo base_url('index.php/admin/produkkeluar/addsubproduk/'.$detail->id_pk.'/'.$data->id_brg_pk) ?>" class="text-info">Detail</a></td>
							</tr>
						<?php endif ?>
						<?php $no++ ?>
					<?php endforeach ?>
				</table>
				<?php else: ?>
					<div class="alert alert-danger"> Belum ada Produk dimasukan</div>	
				<?php endif ?>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<b>Daftar Type Produk</b>
						<span class="text-muted">Daftar Produk pada masing masing Perusahaan / Cabang</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('index.php/admin/produkkeluar/create/') ?>" method="post">
					<input type="text" name="string" class="form-control" placeholder="masukan nomor rangka produk" style="width: 100%" <?php if (!empty($post['string']) ): ?>
								value="<?php echo $post['string'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</form>
				<table class="table mt-2">
					<thead>
						<tr>
							<th>No</th>
							<th>Type</th>
							<th></th>
						</tr>
						<tbody>
							<?php $no = 1 ?>
							<?php foreach ($hasil as $data): ?>
								<form action="<?php echo base_url('index.php/admin/produkkeluar/addproduk/'.$data['id_type']) ?>" method="post">
									<tr>
										<td><?php echo $no; ?></td>
										<td>
											<?php echo $data['nm_type']; ?>
											<input type="hidden" name="id_pk" value="<?php echo $detail->id_pk ?>">
											<input type="hidden" name="id_type" value="<?php echo $data['id_type'] ?>">
										</td>
										<td><button type="submit" name="submit" value="submit" class="btn btn-success btn-sm">Pilih</button></td>
									</tr>
								</form>
							<?php $no++ ?>
							<?php endforeach ?>
						</tbody>
					</thead>
				</table>
				<div class="row mt-2">
					<div class="col">
						<?php echo $pagination; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<b>Rincian Nota</b>
						<span class="text-muted">Form Rincian Nota</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('index.php/admin/produkkeluar/updatenota/'.$detail->id_pk) ?>" method="post">
					<div class="form-group">
						<label>Kode Produk Keluar</label>
						<div class="form-control"><?php echo $detail->kode_pk?></div>
					</div>
					<div class="form-group">
						<label>Nama Karyawan /  Pembuat</label>
						<div class="form-control"><?php echo $detail->nm_user?></div>
					</div>
					<div class="form-group">
						<label>Tgl Buat</label>
						<div class="form-control"><?php echo date('d F Y',strtotime($detail->tgl_buat))?></div>
					</div>
					<div class="form-group">
						<label>Waktu Buat</label>
						<div class="form-control"><?php echo $detail->waktu_buat?></div>
					</div>
					<?php if ($users->id_info_pt == '1'): ?>
						<div class="form-group">
							<label>Asal</label>
							<select name="id_info_pt_asal" class="form-control">
								<?php if ($detail->id_info_pt_asal !=='0'): ?>
								<option value="<?php echo $detail->id_info_pt_asal ?>"><?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$detail->id_info_pt_asal)->nama_info_pt ?></option>
								<option value="">Belum Di Setting</option>
								<?php else: ?>
									<option value="">Belum Di Setting</option>
								<?php endif ?>
								<?php foreach ($dtpt as $data): ?>
									<option value="<?php echo $data->id_info_pt ?>"><?php echo $data->nama_info_pt ?></option>
								<?php endforeach ?>
							</select>
						</div>
					<?php endif ?>
					<div class="form-group">
						<label>Tujuan</label>
						<select name="id_info_pt_tujuan" class="form-control">
							<?php if ($detail->id_info_pt_tujuan !=='0'): ?>
								<option value="<?php echo $detail->id_info_pt_tujuan ?>"><?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$detail->id_info_pt_tujuan)->nama_info_pt ?></option>
								<option value="">Belum Di Setting</option>
							<?php else: ?>
								<option value="">Belum Di Setting</option>
							<?php endif ?>
							<?php foreach ($dtpt as $data): ?>
								<option value="<?php echo $data->id_info_pt ?>"><?php echo $data->nama_info_pt ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<button type="submit" name="submit" value="submit" class="btn btn-success btn-sm">Simpan Rincian Nota</button>
				</form>
			</div>
		</div>
	</div>
</div>