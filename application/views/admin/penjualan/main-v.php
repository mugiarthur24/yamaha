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
					<th>Stat Nota</th>
					<th>Stat STNK</th>
					<th></th>
				</tr>
				<?php if ($hasil == TRUE): ?>
					<?php $no = 1+$row ?>
					<?php foreach ($hasil as $data): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><a href="<?php echo base_url('index.php/admin/penjualan/tambah/'.$data['no_nota_keluar']) ?>" class="pcoded-badge label label-primary"><?php echo $data['no_nota_keluar']; ?></a></td>
							<td>
								<?php if ($data['id_produk'] !=='0' ): ?>
									<?php $getp = $this->Penjualan_m->detailproduk($data['id_produk']) ?>
									<a href="<?php echo base_url('index.php/admin/penjualan/tambah/'.$data['id_nota_keluar']) ?>"><b><?php echo $getp->nm_type; ?></b></a><br/>
									<?php echo $data['no_rangka']; ?>
								<?php else: ?>
									<span class="pcoded-badge label label-warning">Belum di setting</span>
								<?php endif ?>
								
							</td>
							<td>
								<?php if ($data['nm_p_ktp'] == TRUE): ?>
									<?php echo $data['nm_p_ktp'].'<br/>'.$data['no_ktp_p']; ?>
								<?php else: ?>
									<span class="pcoded-badge label label-warning">Belum di setting</span>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['jk_p'] == TRUE): ?>
									<?php echo $data['jk_p']; ?>
								<?php else: ?>
									<span class="pcoded-badge label label-warning">-</span>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_info_pt']!=='0'): ?>
									<?php $getpt = $this->Admin_m->detail_data('info_pt','id_info_pt',$data['id_info_pt']); ?>
									<?php echo substr($getpt->kode_pt,0,35).' ...' ; ?>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_leasing'] == '0'): ?>
									<span class="pcoded-badge label label-success">Cash</span>
								<?php else: ?>
									<b><?php echo $this->Admin_m->detail_data('leasing','id_leasing',$data['id_leasing'])->nm_leasing; ?></b>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_status'] == '1' ): ?>
									<span class="pcoded-badge label label-success">Di Bayar</span>
								<?php else: ?>
									<span class="pcoded-badge label label-danger">Belum Dibayar</span>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_status_stnk'] == '1' ): ?>
									<span class="pcoded-badge label label-success">Selesai</span>
								<?php else: ?>
									<span class="pcoded-badge label label-danger">Belum Selesai</span>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_status'] == '1' ): ?>
									<a href="#" class="text-secondary">Hapus</a>
								<?php else: ?>
									<a href="<?php echo base_url('index.php/admin/penjualan/delnota/'.$data['no_nota_keluar']) ?>" class="text-danger">Hapus</a>
								<?php endif ?>
							</td>
						</tr>
						<?php $no++ ?>
					<?php endforeach ?>
				<?php else: ?>
					<tr>
						<td colspan="10" align="center">Belum ada penjualan hari ini.</td>
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