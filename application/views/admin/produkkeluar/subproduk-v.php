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
				<td colspan="3"><b>Detail Nota Keluar</b></td>
			</tr>
			<tr>
				<td>Kode Produk keluar</td>
				<td>:</td>
				<td><?php echo $detpm->kode_pk; ?></td>
			</tr>
			<tr>
				<td>Pembuat</td>
				<td>:</td>
				<td><?php echo $detpm->nm_user; ?></td>
			</tr>
			<tr>
				<td>Tanggal Buat</td>
				<td>:</td>
				<td><?php echo date('d F Y',strtotime($detpm->tgl_buat)); ?></td>
			</tr>
			<tr>
				<td>Waktu Buat</td>
				<td>:</td>
				<td><?php echo $detpm->waktu_buat; ?></td>
			</tr>
			<tr>
				<td>Asal</td>
				<td>:</td>
				<td><?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$detpm->id_info_pt_asal)->nama_info_pt; ?></td>
			</tr>
			<tr>
				<td>Tujuan</td>
				<td>:</td>
				<td><?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$detpm->id_info_pt_tujuan)->nama_info_pt; ?></td>
			</tr>
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
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<b>Pengisian Barang Pada Struk</b>
				<span class="text-muted">Detail Produk masuk dan detail daftar produk pada Struk</span>
			</div>
		</div>
	</div>
	<div class="card-body">
		<?php if ($users->id_info_pt == '1'): ?>
			<div class="btn-group float-right mb-2">
				<a href="<?php echo base_url('index.php/admin/produkkeluar/addsubpk/'.$detpm->id_pk.'/'.$detbrg->id_brg_pk) ?>" class="btn btn-info btn-sm">Tambah Sub Produk</a>
			</div>
		<?php endif ?>
		<table class="table mt-2" style="font-size: 13px;">
			<tr>
				<th>No</th>
				<th>No Rangka</th>
				<th>No Mesin</th>
				<th>Type</th>
				<th>Warna</th>
				<th>Delaer</th>
				<th></th>
			</tr>
			<?php if ($hasil == TRUE): ?>
				<?php $no = 1 ?>
				<?php foreach ($hasil as $data): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data->no_rangka; ?></td>
						<td><?php echo $data->no_mesin; ?></td>
						<td><?php echo $data->nm_type; ?></td>
						<td><?php echo ucfirst($data->warna); ?></td>
						<td><?php echo $data->nama_info_pt; ?></td>
						<td>
							<?php if ($users->id_info_pt == '1'): ?>
								<?php if ($data->id_validasi =='1'): ?>
									<span href="#" class="text-success">Terkirim</span>
								<?php else: ?>
									<span class="text-danger">Menunggu</span>
								<?php endif ?>
							<?php endif ?>
						</td>
					</tr>
				<?php $no++ ?>
				<?php endforeach ?>
			<?php else: ?>
				<tr><td colspan="8" class="text-center">Tidak ada data ditemukan</td></tr>
			<?php endif ?>
		</table>
	</div>
</div>