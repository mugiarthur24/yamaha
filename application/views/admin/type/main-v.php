<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<b>Daftar Type</b>
						<span class="text-muted">Daftar Type Produk</span>
					</div>
					<?php if ($this->ion_auth->in_group(array('admin'))): ?>
						<div class="col">
							<button class="btn btn-grd-success btn-sm float-right" data-toggle="modal" data-target="#addtype">Tambah type</button>
						</div>
					<?php endif ?>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" style="font-size: 13px;">
						<tr>
							<td class="text-center">No</td>
							<td>Nama Type</td>
							<td>Kode</td>
							<td colspan="2" class="text-center"></td>
						</tr>
						<?php if ($hasil == TRUE): ?>
							<?php $no = 1 ?>
							<?php foreach ($hasil as $data): ?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td><?php echo $data->nm_type; ?></td>
									<td><?php echo $data->kode_type; ?></td>
									<td class="text-center"><a class="text-info" href="<?php echo base_url('index.php/admin/type/edit/'.$data->id_type) ?>"><i class="fa fa-edit"></i> edit</a></td>
									<td class="text-center"><a class="text-danger" href="<?php echo base_url('index.php/admin/type/delete/'.$data->id_type) ?>"><i class="fa fa-trash"></i> hapus</a></td>
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
<div class="modal fade" id="addtype" tabindex="-1" role="dialog" aria-labelledby="addtype" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addtype">Tambah Type</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/type/create') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="nm_type">Nama Type</label>
						<input type="text" class="form-control" name="nm_type" id="nm_type" placeholder="Nama type">
						<small id="nm_type" class="form-text text-muted">Semua type karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="kode_type">Kode Type</label>
						<input type="text" class="form-control" name="kode_type" id="kode_type" placeholder="Kode type">
						<small id="kode_type" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
					</div>
					<div class="form-group">
						<label for="ket_type">Keterangan Type</label>
						<textarea class="form-control" name="ket_type" placeholder="Masukan Keterangan"></textarea>
						<small id="ket_type" class="form-text text-muted">Deskripsi type, maksimal 144 karakter.</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>