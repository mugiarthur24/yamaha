<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<b>Pengisian Barang Pada Struk</b>
				<span class="text-muted">Detail Produk masuk dan detail daftar produk pada Struk</span>
			</div>
		</div>
	</div>
	<div class="card-body">
		<!-- Example single danger button -->
		<div class="btn-group float-right mb-2">
			<button type="button" class="btn btn-info btn-sm  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Tambah Sub Produk
			</button>
			<div class="dropdown-menu">
				<a class="dropdown-item" data-toggle="modal" href="#" data-target="#manual">Manual</a>
				<a class="dropdown-item" data-toggle="modal" href="#" data-target="#excel">Mengunakan Excel</a>
			</div>
		</div>
		<table class="table mt-2" style="font-size: 13px;">
			<tr>
				<th>No</th>
				<th>No Rangka</th>
				<th>No Mesin</th>
				<th>Type</th>
				<th>Warna</th>
				<th>Delaer</th>
				<th>Status</th>
			</tr>
			<?php if ($hasil == TRUE): ?>
				<?php $no = 1 ?>
				<?php foreach ($hasil as $data): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data->no_rangka; ?></td>
						<td><?php echo $data->no_mesin; ?></td>
						<td><?php echo $data->nm_type; ?></td>
						<td><?php echo ucfirst($data->warna); ?></td>
						<td><?php echo $data->nama_info_pt; ?></td>
						<td>
							<?php if ($data->id_validasi !== '1' ): ?>
								<span class="pcoded-badge label label-success">Ada</span>
								<?php else: ?>
									<span class="pcoded-badge label label-danger">Tidak Ada</span>
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
</div>

<!-- Modal -->
<div class="modal fade" id="manual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Manual</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/produkmasuk/prsaddsubproduk/'.$detpm->id_pm.'/'.$detbrg->id_brg_pm) ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Nomor Mesin</label>
								<input type="text" class="form-control" name="no_mesin" placeholder="Masukan Nomor Mesin">
								<small class="form-text text-muted">Hanya dapat menggunakan angka</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Nomor Rangka</label>
								<input type="text" class="form-control" name="no_rangka" placeholder="Masukan Nomor Rangka">
								<small class="form-text text-muted">Hanya dapat menggunakan angka</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Type</label>
								<div class="form-control" style="background-color: #e0e0e0"><?php echo $type->nm_type; ?></div>
								<small class="form-text text-muted">Tidak dapat di edit</small>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label>Merk</label>
								<div class="form-control" style="background-color: #e0e0e0"><?php echo $type->nm_merk; ?></div>
								<small class="form-text text-muted">Tidak dapat di edit</small>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Cc</label>
								<div class="form-control" style="background-color: #e0e0e0"><?php echo $detbrg->cc; ?></div>
								<small class="form-text text-muted">Tidak dapat di edit</small>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label>Warna</label>
								<div class="form-control" style="background-color: #e0e0e0"><?php echo $detbrg->warna; ?></div>
								<small class="form-text text-muted">Tidak dapat di edit</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Tahun Produk</label>
								<input type="text" class="form-control" name="thn_produk" placeholder="Tahun" value="<?php echo date('Y') ?>">
								<small class="form-text text-muted">Hanya dapat menggunakan angka</small>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label>Tanggal Masuk</label>
								<input type="date" class="form-control" name="tgl_masuk" placeholder="Tangal masuk" value="<?php echo date('Y-m-d') ?>">
								<small class="form-text text-muted">Hanya dapat menggunakan format tanggal</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Bahan bakar</label>
								<input type="text" class="form-control" name="bahan_bakar" placeholder="Masukan bahan bakar" value="Bensin">
								<small class="form-text text-muted">Hanya dapat menggunakan angka huruf dan spasi</small>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" name="submit" value="submit" class="btn btn-primary">Simpan Data Produk</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="excel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Menggunakan Data Excel</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>