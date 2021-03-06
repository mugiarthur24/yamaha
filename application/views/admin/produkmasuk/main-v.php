<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<b>Daftar Produk Masuk</b>
				<span class="text-muted">Daftar Produk Masuk pada masing masing Perusahaan / Cabang</span>
			</div>
			<?php if ($this->ion_auth->in_group(array('admin')) && $users->id_info_pt == '1'): ?>
				<div class="col">
					<div class="btn-group float-right mb-2">
						<button type="button" class="btn btn-success btn-sm  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Tambah Produk Masuk
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?php echo base_url('index.php/admin/produkmasuk/crtprodukmasuk') ?>">Manual</a>
							<a class="dropdown-item" data-toggle="modal" href="#" data-target="#excel">Mengunakan Excel</a>
						</div>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>
	<div class="card-body">
		<form action="<?php echo base_url('index.php/admin/produkmasuk/index') ?>" method="post">
			<div class="row">
				<div class="col-md-2">
					<input type="text" name="so_ref" class="form-control" placeholder="masukan SO REF" style="width: 100%" <?php if (!empty($post['so_ref']) ): ?>
								value="<?php echo $post['so_ref'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-2">
					<input type="text" name="so_no" class="form-control" placeholder="masukan SO NO" style="width: 100%" <?php if (!empty($post['so_no']) ): ?>
								value="<?php echo $post['so_no'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-2">
					<input type="date" name="ipdo_date" class="form-control" placeholder="masukan IPDO DATE" style="width: 100%" <?php if (!empty($post['ipdo_date']) ): ?>
								value="<?php echo $post['ipdo_date'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-2">
					<input type="date" name="so_date" class="form-control" placeholder="masukan SO DATE" style="width: 100%" <?php if (!empty($post['so_date']) ): ?>
								value="<?php echo $post['so_date'] ?>"
							<?php endif ?>>
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
						<?php foreach ($status as $data): ?>
							<option value="<?php echo $data->id_status ?>"><?php echo $data->nm_status ?></option>
						<?php endforeach ?>
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
					<th>So Ref</th>
					<th>So No</th>
					<th>Ipdo Date</th>
					<th>So Date</th>
					<th>Status</th>
					<th></th>
				</tr>
				<?php if ($hasil == TRUE): ?>
					<?php $no = 1+$row ?>
					<?php foreach ($hasil as $data): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td>
								<?php if ($data['so_ref'] == TRUE): ?>
									<a href="<?php echo base_url('index.php/admin/produkmasuk/create/'.$data['id_pm']) ?>"><?php echo $data['so_ref']; ?></a>
								<?php else: ?>
									<a href="<?php echo base_url('index.php/admin/produkmasuk/create/'.$data['id_pm']) ?>" class="pcoded-badge label label-primary">Belum disetting</a>
								<?php endif ?>
							</td>
							<td><?php echo $data['so_no']; ?></td>
							<td>
								<?php if ($data['ipdo_date'] !=='0000-00-00'): ?>
									<?php echo date('d F Y',strtotime($data['ipdo_date'])); ?>
								<?php else: ?>
									<?php echo "Belum disetting"; ?>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['so_date'] !== '0000-00-00'): ?>
									<?php echo date('d F Y',strtotime($data['so_date'])); ?>
								<?php else: ?>
									<?php echo "Belum disetting"; ?>
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
								<?php if ($users->id_info_pt =='1'): ?>
									<?php if ($data['id_status'] == '1'): ?>
										<a href="#" class="text-secondary">Hapus</a>
									<?php else: ?>
										<a href="<?php echo base_url('index.php/admin/produkmasuk/delpm/'.$data['id_pm']) ?>" class="text-danger">Hapus</a>
									<?php endif ?>
								<?php endif ?>
							</td>
						</tr>
						<?php $no++ ?>
					<?php endforeach ?>
				<?php else: ?>
					<tr><td colspan="6" class="text-center">Tidak ada data ditemukan</td></tr>
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
<!-- Modal -->
<div class="modal fade" id="excel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url('index.php/admin/produkmasuk/uploadexcel') ?>" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Menggunakan Data Excel</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>File Excel</label>
						<input type="file" class="form-control" name="fileupload" placeholder="Masukan bahan bakar" value="Bensin">
						<small class="form-text text-muted">Hanya dapat menggunakan format .xls</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" name="submit" value="submit" class="btn btn-primary">Upload File Excel</button>
				</div>
			</div>
		</form>
	</div>
</div>