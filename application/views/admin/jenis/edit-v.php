<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<b>Edit Jenis</b>
				<span class="text-muted">Edit Jenis Produk</span>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('index.php/admin/jenis/update/'.$hasil->id_jenis) ?>" method="post">
					<div class="form-group">
						<label for="nm_jenis">Nama jenis</label>
						<input type="text" class="form-control" name="nm_jenis" id="nm_jenis" placeholder="Nama jenis" value="<?php echo $hasil->nm_jenis ?>">
						<small id="nm_jenis" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="kode_jenis">Kode jenis</label>
						<input type="text" class="form-control" name="kode_jenis" id="kode_jenis" placeholder="Kode jenis" value="<?php echo $hasil->kode_jenis ?>">
						<small id="kode_jenis" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
					</div>
					<div class="form-group">
						<label for="ket_jenis">Keterangan jenis</label>
						<textarea class="form-control" name="ket_jenis" placeholder="Masukan Keterangan"><?php echo $hasil->ket_jenis; ?></textarea>
						<small id="ket_jenis" class="form-text text-muted">Deskripsi jenis, maksimal 144 karakter.</small>
					</div>
					<button class="btn btn-grd-success btn-sm float-right">Simpan</button>
					
				</form>
			</div>
		</div>
	</div>
</div>