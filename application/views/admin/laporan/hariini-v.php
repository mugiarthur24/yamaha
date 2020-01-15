<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header"><b>Daftar Nota Pembelian</b></div>
			<div class="card-body">
				<table class="table">
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Leasing</th>
						<th>Byr</th>
						<th>STNK</th>
					</tr>
					<?php if ($hasil == TRUE): ?>
						<?php $no = 1 ?>
						<?php foreach ($hasil as $data): ?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo '<b>'.$data['no_nota_keluar'].'</b><br/>'.$data['nm_p_ktp']; ?></td>
								<td>
									<?php if ($data['id_status_stnk'] !=='0'): ?>
										<b><?php echo $this->Admin_m->detail_data('leasing','id_leasing',$data['id_leasing'])->nm_leasing; ?></b>
									<?php else: ?>
										<b>Cash</b>
									<?php endif ?>
								</td>
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
							</tr>
							<?php $no++ ?>
						<?php endforeach ?>
					<?php else: ?>
						<tr>
							<td colspan="5" class="text-center">Belum ada penjualan hari ini</td>
						</tr>
					<?php endif ?>
				</table>
			</div>
		</div>
	</div>
	<div class="col"></div>
</div>