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