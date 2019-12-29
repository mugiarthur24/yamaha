<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<b>Daftar Penjualan Harian</b>
				<span class="text-muted">Penjualan pertanggan hari ini, <?php echo date('d F Y',strtotime($tgl)); ?></span>
			</div>
			<?php if ($this->ion_auth->in_group(array('admin','members'))): ?>
				<div class="col">
					<a href="<?php echo base_url('index.php/admin/penjualan/create') ?>" class="btn btn-grd-success btn-sm float-right">Tambah Penjualan Hari Ini</a>
				</div>
			<?php endif ?>
		</div>
	</div>
	<div class="card-body">
		<form action="<?php echo base_url('index.php/admin/penjualan/index') ?>" method="post">
			<div class="row">
				<div class="col-md-11">
					<input type="text" name="string" class="form-control" placeholder="No / Kode Penjualan" style="width: 100%" <?php if (!empty($post['string']) ): ?>
								value="<?php echo $post['string'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-1">
					<button type="submit" name="submit" value="submit" class="btn btn-success btn-sm w-100">Cari</button>
				</div>
			</div>
		</form>
		<div class="table-responsive">
			<table class="table" style="font-size: 13px;">
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Produk</th>
					<th>Nama / KTP</th>
					<th>JK</th>
					<th>Dealer</th>
					<th>Leasing</th>
					<th>Status</th>
					<th></th>
				</tr>
				<?php if ($hasil == TRUE): ?>
					<?php $no = 1+$row ?>
					<?php foreach ($hasil as $data): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['no_nota_keluar']; ?></td>
							<td>
								<a href="<?php echo base_url('index.php/admin/users/detail/'.$data['id_nota_keluar']) ?>"><b><?php echo $data['nm_type']; ?></b></a><br/>
								<?php echo $data['no_rangka']; ?>
							</td>
							<td><?php echo $data['nm_p_ktp'].'<br/>'.$data['no_ktp_p']; ?></td>
							<td><?php echo $data['jk_p']; ?></td>
							<td><?php echo substr($data['nama_info_pt'],0,35).' ...' ; ?></td>
							<td>
								<?php if ($data['id_leasing'] == '0'): ?>
									<span class="pcoded-badge label label-success">Cash</span>
								<?php else: ?>
									<b><?php echo $this->Admin_m->detail_data('leasing','id_leasing',$data['nm_leasing'])->nm_leasing; ?></b>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_status'] == '1' ): ?>
									<span class="pcoded-badge label label-success">Selesai</span>
								<?php else: ?>
									<span class="pcoded-badge label label-danger">Belum Selesai</span>
								<?php endif ?>
							</td>
						</tr>
						<?php $no++ ?>
					<?php endforeach ?>
				<?php else: ?>
					<tr>
						<td colspan="9" align="center">Belum ada penjualan hari ini.</td>
					</tr>
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