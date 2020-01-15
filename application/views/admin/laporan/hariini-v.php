<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">
				<b>Laporan Penjualan Harian</b>
				<span class="text-muted">Laporan Penjualan pertanggan hari ini, <?php echo date('d F Y',strtotime($tgl)); ?></span>
			</div>
			<div class="card-body">
				<table class="table">
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Byr</th>
						<th>STNK</th>
						<th>Harga</th>
					</tr>
					<?php if ($hasil == TRUE): ?>
						<?php $no = 1 ?>
						<?php $harga_nota = 0 ?>
						<?php foreach ($hasil as $data): ?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo '<b>'.$data['no_nota_keluar'].'</b><br/>'.$data['nm_p_ktp']; ?></td>
								<td>
									<?php if ($data['id_status'] !=='0'): ?>
										<span class="pcoded-badge label label-success">Sudah</span>
									<?php else: ?>
										<span class="pcoded-badge label label-warning">Belum</span>
									<?php endif ?>
								</td>
								<td>
									<?php if ($data['id_status_stnk'] !=='0'): ?>
										<span class="pcoded-badge label label-success">Sudah</span>
									<?php else: ?>
										<span class="pcoded-badge label label-warning">Belum</span>
									<?php endif ?>
								</td>
								<td><?php echo 'Rp.'.number_format($data['jml_bayar']); ?></td>
							</tr>
							<?php $no++ ?>
							<?php $harga_nota = $data['jml_bayar']+(int)@$harga_nota; ?>
						<?php endforeach ?>
						<tr>
							<td colspan="4" class="text-right"><b>Total</b></td>
							<td><b><?php echo 'Rp.'.number_format($harga_nota); ?></b></td>
						</tr>
					<?php else: ?>
						<tr>
							<td colspan="5" class="text-center">Belum ada penjualan hari ini</td>
						</tr>
					<?php endif ?>
				</table>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card">
			<div class="card-header">
				<b>Produk Terjual</b>
				<span class="text-muted">Daftar Produk dan Jumlahnya Terjual pertanggan hari ini, <?php echo date('d F Y',strtotime($tgl)); ?></span>
			</div>
			<div class="card-body">
				<table class="table">
					<tr>
						<th>No</th>
						<th>Type</th>
						<th>Jml</th>
					</tr>
					<?php $no =1 ?>
					<?php foreach ($produk as $data): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data->nm_type; ?></td>
							<td><?php echo $data->total.' Unit'; ?></td>
						</tr>
						<?php $no++ ?>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
</div>