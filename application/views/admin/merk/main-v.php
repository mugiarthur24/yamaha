<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<b>Daftar Merk</b>
						<span class="text-muted">Daftar Merk Produk</span>
					</div>
					<?php if ($this->ion_auth->in_group(array('admin'))): ?>
						<div class="col">
							<button class="btn btn-grd-success btn-sm float-right" data-toggle="modal" data-target="#addmerk">Tambah Merk</button>
						</div>
					<?php endif ?>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" style="font-size: 13px;">
						<tr>
							<td class="text-center">No</td>
							<td>Nama Merk</td>
							<td>Kode</td>
							<td colspan="2" class="text-center"></td>
						</tr>
						<?php if ($hasil == TRUE): ?>
							<?php $no = 1 ?>
							<?php foreach ($hasil as $data): ?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td><?php echo $data->nm_merk; ?></td>
									<td><?php echo $data->kode_merk; ?></td>
									<td class="text-center"><a class="text-info" href="<?php echo base_url('index.php/admin/merk/edit/'.$data->id_merk) ?>"><i class="fa fa-edit"></i> edit</a></td>
									<td class="text-center"><a class="text-danger" href="<?php echo base_url('index.php/admin/merk/delete/'.$data->id_merk) ?>"><i class="fa fa-trash"></i> hapus</a></td>
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
<div class="modal fade" id="addmerk" tabindex="-1" role="dialog" aria-labelledby="addmerk" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addmerk">Tambah Merk</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/merk/create') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="nm_merk">Nama Merk</label>
						<input type="text" class="form-control" name="nm_merk" id="nm_merk" placeholder="Nama merk">
						<small id="nm_merk" class="form-text text-muted">Semua merk karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="kode_merk">Kode Merk</label>
						<input type="text" class="form-control" name="kode_merk" id="kode_merk" placeholder="Kode merk">
						<small id="kode_merk" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
					</div>
					<div class="form-group">
						<label for="ket_merk">Keterangan Merk</label>
						<textarea class="form-control" name="ket_merk" placeholder="Masukan Keterangan"></textarea>
						<small id="ket_merk" class="form-text text-muted">Deskripsi merk, maksimal 144 karakter.</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>