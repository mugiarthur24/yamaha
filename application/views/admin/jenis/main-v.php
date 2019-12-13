<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<b>Daftar Jenis</b>
						<span class="text-muted">Daftar Jenis Produk</span>
					</div>
					<?php if ($this->ion_auth->in_group(array('admin'))): ?>
						<div class="col">
							<button class="btn btn-grd-success btn-sm float-right" data-toggle="modal" data-target="#addjenis">Tambah Jenis</button>
						</div>
					<?php endif ?>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" style="font-size: 13px;">
						<tr>
							<td class="text-center">No</td>
							<td>Nama jenis</td>
							<td>Kode</td>
							<td colspan="2" class="text-center"></td>
						</tr>
						<?php if ($hasil == TRUE): ?>
							<?php $no = 1 ?>
							<?php foreach ($hasil as $data): ?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td><?php echo $data->nm_jenis; ?></td>
									<td><?php echo $data->kode_jenis; ?></td>
									<td class="text-center"><a class="text-info" href="<?php echo base_url('index.php/admin/jenis/edit/'.$data->id_jenis) ?>"><i class="fa fa-edit"></i> edit</a></td>
									<td class="text-center"><a class="text-danger" href="<?php echo base_url('index.php/admin/jenis/delete/'.$data->id_jenis) ?>"><i class="fa fa-trash"></i> hapus</a></td>
								</tr>
								<?php $no++ ?>
							<?php endforeach ?>
						<?php else: ?>
							<tr>
								<td colspan="4" class="text-center">Tidak ada data ditemukan</td>
							</tr>
						<?php endif ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="addjenis" tabindex="-1" role="dialog" aria-labelledby="addjenis" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addjenis">Tambah jenis</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/jenis/create') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="nm_jenis">Nama jenis</label>
						<input type="text" class="form-control" name="nm_jenis" id="nm_jenis" placeholder="Nama jenis">
						<small id="nm_jenis" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="kode_jenis">Kode jenis</label>
						<input type="text" class="form-control" name="kode_jenis" id="kode_jenis" placeholder="Kode jenis">
						<small id="kode_jenis" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
					</div>
					<div class="form-group">
						<label for="ket_jenis">Keterangan jenis</label>
						<textarea class="form-control" name="ket_jenis" placeholder="Masukan Keterangan"></textarea>
						<small id="ket_jenis" class="form-text text-muted">Deskripsi jenis, maksimal 144 karakter.</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>