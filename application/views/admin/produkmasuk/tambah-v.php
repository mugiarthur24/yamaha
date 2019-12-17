<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<b>Tambah Produk Masuk</b>
				<span class="text-muted">Tambah Produk Masuk pada masing masing Perusahaan / Cabang</span>
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
						<b>Daftar Barang Masuk</b>
						<span class="text-muted">Daftar Barang pada nota</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<?php if ($barang == TRUE): ?>
				
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
				<form action="<?php echo base_url('index.php/admin/produkmasuk/create/') ?>" method="post">
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
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $data['nm_type']; ?></td>
									<td><a href="#">Pilih</a></td>
								</tr>
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
				<form>
					<div class="form-group">
						<label>No So Ref</label>
						<input type="text" name="so_ref" class="form-control" placeholder="Masukan SO REF">
					</div>
					<div class="form-group">
						<label>So No</label>
						<input type="text" name="so_no" class="form-control" placeholder="Masukan SO No">
					</div>
					<div class="form-group">
						<label>IPDO No</label>
						<input type="text" name="ipdo_no" class="form-control" placeholder="Masukan IPDO No">
					</div>
					<div class="form-group">
						<label>IPDO Date</label>
						<input type="date" name="ipdo_date" class="form-control" value="<?php echo date('Y-m-d') ?>">
					</div>
					<div class="form-group">
						<label>SO Date</label>
						<input type="date" name="so_date" class="form-control" value="<?php echo date('Y-m-d') ?>">
					</div>
					<button type="submit" name="submit" value="submit" class="btn btn-success btn-sm">Simpan RIncian Nota</button>
				</form>
			</div>
		</div>
	</div>
</div>