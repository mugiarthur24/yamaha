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
				<table class="table">
					<tr>
						<th>No</th>
						<th>Type</th>
						<th>Cc</th>
						<th>Warna</th>
						<th>Stok</th>
						<th></th>
					</tr>
					<?php $no = 1 ?>
					<?php foreach ($barang as $data): ?>
						<form action="<?php echo base_url('index.php/admin/produkmasuk/updatelistbarang/'.$data->id_brg_pm) ?>" method ="post">
							<tr>
								<td><?php echo $no; ?><input type="hidden" name="id_pm" value="<?php echo $detail->id_pm ?>"></td>
								<td><?php echo $data->nm_type; ?> <input type="hidden" name="id_brg_pm" value="<?php echo $data->id_brg_pm ?>"></td>
								<td>
									<input type="text" class="form-control" name="cc" <?php if ($data->cc == TRUE): ?>
									value="<?php echo $data->cc ?>"
									<?php else: ?>
										value="0"
									<?php endif ?>>
								</td>
								<td>
									<input type="text" class="form-control" name="warna" <?php if ($data->warna == TRUE): ?>
									value="<?php echo $data->warna ?>"
									<?php else: ?>
										value="-"
									<?php endif ?>>
								</td>
								<td>
									<input type="text"  class="form-control"name="jml_brg" <?php if ($data->warna == TRUE): ?>
									value="<?php echo $data->jml_brg ?>"
									<?php else: ?>
										value="0"
									<?php endif ?> onchange="this.form.submit()">
								</td>
								<td><a href="<?php echo base_url('index.php/admin/produkmasuk/addsubproduk/'.$detail->id_pm.'/'.$data->id_brg_pm) ?>" class="text-info">Detail</a></td>
								<td><a href="<?php echo base_url('index.php/admin/produkmasuk/delproduk/'.$data->id_brg_pm) ?>" class="text-danger">Hapus</a></td>
							</tr>
						</form>
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
								<form action="<?php echo base_url('index.php/admin/produkmasuk/addproduk/'.$data['id_type']) ?>" method="post">
									<tr>
										<td><?php echo $no; ?></td>
										<td>
											<?php echo $data['nm_type']; ?>
											<input type="hidden" name="id_pm" value="<?php echo $detail->id_pm ?>">
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
				<form action="<?php echo base_url('index.php/admin/produkmasuk/updatenota/'.$detail->id_pm) ?>" method="post">
					<div class="form-group">
						<label>No So Ref</label>
						<input type="text" name="so_ref" class="form-control" value="<?php echo $detail->so_ref?>" placeholder="Masukan SO REF">
					</div>
					<div class="form-group">
						<label>So No</label>
						<input type="text" name="so_no" class="form-control" value="<?php echo $detail->so_no?>" placeholder="Masukan SO No">
					</div>
					<div class="form-group">
						<label>IPDO No</label>
						<input type="text" name="ipdo_no" class="form-control" value="<?php echo $detail->ipdo_no?>" placeholder="Masukan IPDO No">
					</div>
					<div class="form-group">
						<label>IPDO Date</label>
						<input type="date" name="ipdo_date" class="form-control" <?php if ($detail->ipdo_date == TRUE): ?>
							value="<?php echo date('Y-m-d',strtotime($detail->ipdo_date)) ?>"
						<?php else: ?>
							value="<?php echo date('Y-m-d') ?>"
						<?php endif ?> >
					</div>
					<div class="form-group">
						<label>SO Date</label>
						<input type="date" name="so_date" class="form-control" <?php if ($detail->so_date == TRUE): ?>
							value="<?php echo date('Y-m-d',strtotime($detail->so_date)) ?>"
						<?php else: ?>
							value="<?php echo date('Y-m-d') ?>"
						<?php endif ?> >
					</div>
					<button type="submit" name="submit" value="submit" class="btn btn-success btn-sm">Simpan RIncian Nota</button>
				</form>
			</div>
		</div>
	</div>
</div>