<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<b>Daftar Finance</b>
						<span class="text-muted">Daftar Finance</span>
					</div>
					<?php if ($this->ion_auth->in_group(array('admin'))): ?>
						<div class="col">
							<button class="btn btn-grd-success btn-sm float-right" data-toggle="modal" data-target="#addleasing">Tambah Data Finance</button>
						</div>
					<?php endif ?>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" style="font-size: 13px;">
						<tr>
							<td class="text-center">No</td>
							<td>Kode</td>
							<td>Nama Finance</td>
							<td>Area</td>
							<td>Keterangan</td>
							<td colspan="2" class="text-center"></td>
						</tr>
						<?php if ($hasil == TRUE): ?>
							<?php $no = 1 ?>
							<?php foreach ($hasil as $data): ?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td><?php echo $data->kode_leasing; ?></td>
									<td><?php echo $data->nm_leasing; ?></td>
									<td><?php echo $data->area; ?></td>
									<td><?php echo $data->ket_leasing; ?></td>
									<td class="text-center"><a class="text-info" href="<?php echo base_url('index.php/admin/finance/edit/'.$data->id_leasing) ?>"><i class="fa fa-edit"></i> edit</a></td>
									<td class="text-center"><a class="text-danger" href="<?php echo base_url('index.php/admin/finance/delete/'.$data->id_leasing) ?>"><i class="fa fa-trash"></i> hapus</a></td>
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
<div class="modal fade" id="addleasing" tabindex="-1" role="dialog" aria-labelledby="addleasing" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addleasing">Tambah Finance</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/finance/create') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="kode_leasing">Kode Finance</label>
						<input type="text" class="form-control" name="kode_leasing" id="kode_leasing" placeholder="Kode Finance">
						<small id="kode_leasing" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="nm_leasing">Nama Finance</label>
						<input type="text" class="form-control" name="nm_leasing" id="nm_leasing" placeholder="Nama Leasing">
						<small id="nm_leasing" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
					</div>
					<div class="form-group">
						<label for="area">Area</label>
						<input type="text" class="form-control" name="area" id="area" placeholder="Area">
						<small id="area" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
					</div>
					<div class="form-group">
						<label for="ket_leasing">Keterangan</label>
						<textarea class="form-control" name="ket_leasing" placeholder="Masukan Keterangan"></textarea>
						<small id="ket_leasing" class="form-text text-muted">Deskripsi jenis, maksimal 144 karakter.</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>