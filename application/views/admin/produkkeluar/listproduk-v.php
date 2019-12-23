<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<b>Detail Produk Keluar</b>
				<span class="text-muted">Detail Produk Keluar Sesuai dengan Struk yang di pilih</span>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table>
			<tr>
				<td colspan="3"><b>Detail Produk Keluar</b></td>
			</tr>
			<tr>
				<td>Jenis</td>
				<td>:</td>
				<td><?php echo $detbrg->nm_jenis; ?></td>
			</tr>
			<tr>
				<td>Merk</td>
				<td>:</td>
				<td><?php echo $detbrg->nm_merk; ?></td>
			</tr>
			<tr>
				<td>Type</td>
				<td>:</td>
				<td><?php echo $detbrg->nm_type; ?></td>
			</tr>
			<tr>
				<td>CC</td>
				<td>:</td>
				<td><?php echo $detbrg->cc; ?></td>
			</tr>
			<tr>
				<td>Type</td>
				<td>:</td>
				<td><?php echo $detbrg->warna; ?></td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td>:</td>
				<td><?php echo $detbrg->jml_brg.' Unit'; ?></td>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<b>Daftar Produk di Gudang Asal</b>
						<span class="text-muted">List Produk terkait yang terpadat pada gudang saat ini atau gudang asal</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>Gudang Asal</label>
					<select name="id_info_pt_asal" class="form-control">
						<option value="<?php echo $users->id_info_pt ?>">--<?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$users->id_info_pt)->nama_info_pt; ?>--</option>
						<?php if ($users->id_info_pt == '1'): ?>
							<?php foreach ($dtpt as $data): ?>
								<option value="<?php echo $data->id_info_pt ?>"><?php echo $data->nama_info_pt; ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
					<small class="form-text text-muted">Pilih dari salah satu data diatas</small>
				</div>
				<table class="table" >
					<?php $noasal = 1 ?>
					<?php foreach ($gudangasal as $data): ?>
						<tr >
							<td style="vertical-align: middle;"><?php echo $noasal; ?></td>
							<td style="vertical-align: middle;">
								<b><?php echo $data->nm_type; ?></b><br/>
								<span class="pcoded-badge label label-primary"><?php echo $data->no_rangka; ?></span>
								<span class="pcoded-badge label label-inverse "><?php echo $data->no_mesin; ?></span>
							</td>
							<td style="vertical-align: middle;">
								<span class="pcoded-badge label label-primary">
									<input type="checkbox" name="pilih[]" value="<?php echo $data->id_produk ?>"> Pilih Produk
								</span>
							</td>
						</tr>
						<?php $noasal++ ?>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<b>Daftar Produk di Gudang Lain</b>
						<span class="text-muted">List Produk terkait yang terpadat pada gudang lain atau daerah lain</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>Gudang Lain</label>
					<select name="id_info_pt_asal" class="form-control">
						<option value="">Pilih Gudang Lain</option>
						<?php foreach ($dtpt as $data): ?>
							<option value="<?php echo $data->id_info_pt ?>"><?php echo $data->nama_info_pt; ?></option>
						<?php endforeach ?>
					</select>
					<small class="form-text text-muted">Pilih dari salah satu data diatas</small>
				</div>
				<?php if ($gudanglain == TRUE): ?>
					<table class="table" >
						<?php $nolain = 1 ?>
						<?php foreach ($gudanglain as $data): ?>
							<tr >
								<td style="vertical-align: middle;"><?php echo $nolain; ?></td>
								<td style="vertical-align: middle;">
									<b><?php echo $data->nm_type; ?></b><br/>
									<span class="pcoded-badge label label-primary"><?php echo $data->no_rangka; ?></span>
									<span class="pcoded-badge label label-inverse "><?php echo $data->no_mesin; ?></span>
								</td>
								<td style="vertical-align: middle;">
									<span class="pcoded-badge label label-primary">
										<input type="checkbox" name="pilih[]" value="<?php echo $data->id_produk ?>"> Pilih Produk
									</span>
								</td>
							</tr>
							<?php $nolain++ ?>
						<?php endforeach ?>
					</table>
				<?php else: ?>
					<div class="alert alert-success">Gudang Lain belum di pilih</div>
				<?php endif ?>
					
			</div>
		</div>
	</div>
</div>